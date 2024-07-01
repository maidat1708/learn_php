<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request){
        $user = new User();
        $field = $request->validate([
            "name" => ['required', Rule::unique('users','name')],
            "email" => ["required", Rule::unique("users","email")],
            "password"=> ["required", Rule::unique("users","password")],
        ]);
        $field['password'] = bcrypt($request->password);
        $addUser = $user->addUser($field);
        auth()->login($addUser);
        return to_route('authors.index');
    }
    public function index()
    {
        //
        return view('register.register');
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
