<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function Index(){
        $title = "Learn Laravel";
        $x = 0;
        $y = 1;
        // compact send data
        // return view("products.index",compact("title","x","y"));
        // 'with' send data
        // return view("products.index") ->with("title",$title) -> with("x",$x) -> with("y",$y);
        // send an associative array
        $myphone = [
            'name' => 'Mai Dat',
            'year' => '17/08/2002',
        ];
        // return view('products.index',compact('myphone'));
        //send directly
        // return view('products.index',[
        //     'title'=> $title,
        //     'myphone' => $myphone
        // ]);
        print_r(route('index'));
        return view("products.index");
    }
    public function Detail(Request $request){
        return "Product id = ". $request->id;
    }
}
