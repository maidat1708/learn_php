<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //register
    private User $user;
    public function __construct(User $user){
        $this->user = $user;
    }
    public function register(Request $request)
    {
        $field = $request->validate([
            "name" => ['required', Rule::unique('users', 'name')],
            "email" => ["required", Rule::unique("users", "email")],
            "age" => ["required"],
            "password" => ["required", "confirmed"],
        ]);
        Log::info($field);
        $field['password'] = bcrypt($request->password);
        $addUser = $this->user->addUser($field);
        auth()->login($addUser);
        return to_route('authors.index');
    }
    public function login(Request $request)
    {
        $field = $request->validate([
            "email" => ['required'],
            "password" => ["required"],
        ]);
        Log::info($field);
        if (Auth::attempt(["email" => $field['email'], "password" => $field['password']])) {
            $request->session()->regenerate();
            return to_route("authors.index");
        }
        return redirect('/');
    }
    public function index()
    {
        if (auth()->check()) return to_route("authors.index");
        return view('login.login');
    }
    public function showRegister()
    {
        return view('register.register');
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function showForgotPassword()
    {
        return view('login.forgotPassword');
    }

    public function showOTP(Request $request)
    {
        return view('login.otp',[
                'otp'=> $request->otp,
                'error'=> $request->error,
            ]);
    }
    public function showResetPassword(){
        return view('login.resetPassword');
    }
    public function confirmEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        $email = $validated['email'];
        $otp = helper()->generateOTP();
        $data = [
            'title' => 'OTP Verification',
            'subject' => 'OTP Verification (Laravel)',
            'otp' => $otp,
        ];
        // Send OTP email
        Mail::to($email)->send(new ForgotPasswordMail($data));

        // Optionally, store the OTP in the session or database
        session(['otp' => $otp]);
        session(['email'=>$email]);
        return to_route('showOTP',[
            'otp'=> $otp,
            'error'=> null
        ]);
        // return view('login.otp',[
        //     'otp'=> $otp,
        //     'error'=> null
        // ]);
    }
    public function verifyOTP(Request $request){
        $validated = $request->validate([
            'otp' => 'required|digits:6'
        ]);
        $otp = $validated['otp'];
        if ($otp == session('otp')) {
            return to_route('showResetPassword');
        } else {
            // return redirect()->route('otp.show')->withErrors(['otp' => 'Invalid OTP. Please try again.']);
            return to_route('showOTP',[
                'otp' => $otp,
                'error' => 'Invalid OTP. Please try again.',
            ]);
            // return view('login.otp',[
            //     'otp' => $otp,
            //     'error' => 'Invalid OTP. Please try again.',
            // ]);
        }
    }
    public function resetPassword(Request $request)
    {
        $field = $request->validate([
            "password" => ["required", "confirmed"],
        ]);
        $user1 = $this->user->where("email",session('email'))->first();
        $field['password'] = bcrypt($request->password);
        $user1->password = $field['password'];
        $user1->save();
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
