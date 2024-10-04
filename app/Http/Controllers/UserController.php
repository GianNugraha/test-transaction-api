<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Login API
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = Str::random(60);
        $user->api_token = $token;
        $user->api_token_expired_at = now()->addHours(2);
        $user->save();

        return response()->json(['token' => $token], 200);
    }

    // Logout API
    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->api_token = null;
            $user->api_token_expired_at = null;
            $user->save();
            return response()->json(['message' => 'Successfully logged out'], 200);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }
}
