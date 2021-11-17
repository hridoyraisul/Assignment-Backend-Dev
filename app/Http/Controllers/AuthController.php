<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\UserSignInRequest;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $UserRepo;
    public function __construct(UserInterface $userInterface)
    {
        $this->UserRepo = $userInterface;
    }
    //API--------------------------------------------------
    public function userSignUp(SignUpRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->UserRepo->signUpUser($request);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['user' => $user, 'status'=> 'success', 'token' => $token],201);
    }

    public function userSignIn(UserSignInRequest $request): \Illuminate\Http\JsonResponse
    {
        if (!Auth::attempt($request->only('phone','password'))) {
            return response()->json(['status'=> 'failed', 'message'=>'Invalid credentials'],500);
        }
        $token = Auth::user()->createToken('auth_token')->plainTextToken;
        return response()->json(['user' => Auth::user(), 'status'=> 'success', 'token' => $token],200);
    }

    //WEB--------------------------------------------------
    public function authPage()
    {
        if (Auth::user() != null){
            return redirect()->route('dashboard');
        }
        return view('pages.auth');
    }

    public function signInAdmin(SignInRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (!Auth::attempt($request->only('email','password')) || Auth::user()->type != 'admin') {
            return redirect()->back()->with(['error' => 'Invalid credentials']);
        }
        return redirect()->route('dashboard');
    }

    public function signOutAdmin(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
