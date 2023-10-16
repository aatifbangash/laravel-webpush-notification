<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function register(Request $request): JsonResponse
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generate an API token for the user
        $token = $user->createToken('auth_token',[
            'post:create',
            'post:update',
            'post:delete',
            'post:get',

            'category:create',
            'category:update',
            'category:delete',
            'category:get'
        ])->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token', [
                'role:admin',
                'post:create',
                'post:update',
                'post:delete',
                'post:get',

                'category:create',
                'category:update',
                'category:delete',
                'category:get'
            ])->plainTextToken;

            return response()->json(['token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }

    public function me(Request $request): mixed {
        return $request->user()->currentAccessToken();
        return $request->user()->tokenCan('post:create');
    }

    public function me2(Request $request): mixed {
        return $request->user()->currentAccessToken();
    }
}
