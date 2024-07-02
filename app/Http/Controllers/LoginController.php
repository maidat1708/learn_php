<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //register
    public function register(Request $request){
        $user = new User();
        $field = $request->validate([
            "name" => ['required', Rule::unique('users','name')],
            "email" => ["required", Rule::unique("users","email")],
            "age"=> ["required"],
            "password"=> ["required","confirmed"],
        ]);
        Log::info($field);
        $field['password'] = bcrypt($request->password);
        $addUser = $user->addUser($field);
        auth()->login($addUser);
        return to_route('authors.index');
    }
    public function login(Request $request){
        $field = $request->validate([
            "email" => ['required'],
            "password"=> ["required"],
        ]);
        Log::info($field);
        if(Auth::attempt(["email"=> $field['email'] ,"password"=> $field['password']])){
            $request->session()->regenerate();
            return to_route("authors.index");
        }
        return redirect('/');
    }
    public function index()
    {
        if(auth()->check()) return to_route("authors.index");
        return view('login.login');
    }
    public function showRegister()
    {
        return view('register.register');
    }
    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
