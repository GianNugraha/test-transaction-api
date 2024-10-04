<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));
            $user->api_token_expired_at = now()->addHours(1);
            $user->save();

            return response()->json(['token' => $user->api_token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->api_token = null;
        $user->save();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
