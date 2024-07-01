<?php

namespace App\Http\Controllers;

use App\ErrorCode;
use App\Exceptions\CustomException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginControllerAPI extends Controller
{

    public function register(RegisterRequest $request){
        $user = new User();
        $field = $request->validated();

        $field['password'] = bcrypt($request->password);
        $addUser = $user->addUser($field);
        auth()->login($addUser);
        $token = auth()->user()->createToken('Personal Access Token')->accessToken;
        return ApiResponse::success([
            'user' => new UserResource(auth()->user()),
            'token' => $token,
        ], 'Register successful');
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Register successful',
        //     'data' => [
        //         'user' => new UserResource(auth()->user()),
        //         'token' => $token,
        //     ]
        // ]);
    }

    //function login with Validated Request
    public function login(LoginRequest $request){
        $field = $request->validated();
        if (Auth::attempt((["email"=> $field['email'] ,"password"=> $field['password']]))) {
            // Authentication passed...
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->accessToken;
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Login successful',
            //     'data' => [
            //         'user' => new UserResource($user),
            //         'token' => $token,
            //     ]
            // ]);
            return ApiResponse::success([
                'user' => new UserResource($user),
                'token' => $token,
            ], 'Login successful');
        }
        return ApiResponse::responseException(ErrorCode::UNAUTHORIZED);
        // return response()->json([
        //     'success' => false,
        //     'message' => 'Login failed, invalid credentials'
        // ], 401);
    }
    public function index()
    {
        //
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
