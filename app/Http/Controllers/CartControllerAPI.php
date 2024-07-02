<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CartControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Cart $cart;
    private Product $product;
    public function __construct(Cart $cart, Product $product){
        $this->cart = $cart;
        $this->product = $product;
    }
    public function addToCart(Request $request)
    {
        $product = $this->product->find($request->product_id);
        $cart = $request->session()->get('cart', []);

        // nếu product-id tồn tại thì tăng số lượng
        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['price']+=$product->price;
        } else {
            $cart[$product->id] = [
                'product' => $product->id,
                'quantity' => 1,
                'price' => $product->price
            ];
        }

        // Lưu giỏ hàng vào session
        $request->session()->put('cart', $cart);

        return ApiResponse::success(["cart"=>$cart]);
    }

    public function viewCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        // session()->get('hello');
        return ApiResponse::success(["cart"=>$cart]);
    }

    public function removeFromCart(Request $request)
    {
        $product = $this->product->find($request->product_id);
        $cart = $request->session()->get('cart', []);

        if (array_key_exists($product->id, $cart)) {
            unset($cart[$product->id]);
            $request->session()->put('cart', $cart);

            return ApiResponse::success(["cart"=>$cart],'Product removed from cart successfully');
        }

        return ApiResponse::error('Product not found in cart.',404);
    }
    public function getCache(){
        $value = Cache::get('carts');

        if ($value) {
            return ApiResponse::success($value,"get cache successful");
        } else {
            // Nếu không tìm thấy trong cache, thực hiện hành động khác
            return ApiResponse::error("No cache",404);
        }
    }
    public function index()
    {
        //
        // return $this->cart::all()->load('products');
        $timeStart = microtime(true);
        $carts = Cache::remember('cache_carts',20, function () {
            Log::info('cache carts');
            return $this->cart->all();
        });
        // Cache::forget('cache_carts');
        Cache::put('carts','demo cache cart',20);
        if(!$carts){
            return ApiResponse::error("Cart not found!!!",404);
        }
        $timeExe = microtime(true) - $timeStart;
        return ApiResponse::testPerformance(new CartCollection($carts),$timeExe,"Get carts successful");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
