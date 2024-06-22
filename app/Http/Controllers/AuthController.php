<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
        ]);

        $user = new User([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);

        if ($user->save()) {
            return response()->json([
                'message' => 'Admin registered successfully',
            ], 201);
        } else {
            return response()->json(['error' => 'Admin registration unsuccessful'], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        $response = response()->json([
            'accessToken' => $token,
            'token_type' => 'Bearer',
        ], 200);
        $response->cookie('access_token', $token, 0, null, null, false, true); // posledný parameter HttpOnly

        return $response;
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        $response = response()->json([
            'message' => 'Logged out successfully'
        ], 200);
        $response->cookie('access_token', '', 0, null, null, false, true);

        return $response;
        }
}
