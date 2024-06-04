<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['email'],
            'password' => ['required'],
        ]);

        $success = Auth::attempt($validated);
        if (!$success) {
            return response()->json([
                'message' => '¡Credenciales Incorrectas!'
            ], 422);
        }

        $user = Auth::user();
        $remember = $user->remember_token;
        $token = $user->createToken($remember)->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->noContent();
    }

    public function alive()
    {
        return response()->noContent();
    }

    public function register()
    {
        return response()->noContent();
    }

    public function permissions()
    {
        return response()->noContent();
    }
}
