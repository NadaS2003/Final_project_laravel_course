<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'email or password is wrong'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('access_token')->accessToken;

        return response()->json([
            'user'  => $user,
            'token' => $token
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logout'
        ]);
    }
}


