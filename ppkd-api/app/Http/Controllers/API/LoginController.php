<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Fail',
                    'errors' => $validator->errors()
                ], 422);
            }

            $credentials =  $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $user = Auth::user();
            $tokenResult = $user->createToken('api-token');
            $token = $tokenResult->plainTextToken;

            // update expired_at manual
            $tokenResult->accessToken->update([
                'expires_at' => now()->addMinutes(60) // expired 1 jam
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Login Success',
                'token' => $token,
                'expired_at' => $tokenResult->accessToken->expires_at,
                'user' => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ]);
    }

    // User Profile
    public function me()
    {
        return response()->json([
            'user' => auth('sanctum')->user()
        ]);
    }
}
