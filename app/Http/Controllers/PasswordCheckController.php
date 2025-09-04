<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PasswordCheckController extends Controller
{
    /**
     * Display information about a user's password.
     */
    public function checkPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();
            
            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                    'status' => 'error'
                ]);
            }
            
            $passwordCheck = Hash::check($request->password, $user->password);
            
            // If password doesn't match, let's check if it might be stored directly
            $directMatch = ($request->password === $user->password);
            
            // Log detailed info for debugging
            Log::info('Password check', [
                'user_id' => $user->id,
                'password_length' => strlen($user->password),
                'hash_check_result' => $passwordCheck,
                'direct_match' => $directMatch
            ]);
            
            return response()->json([
                'message' => $passwordCheck ? 'Password matches' : 'Password does not match',
                'direct_match' => $directMatch,
                'password_length' => strlen($user->password),
                'password_is_hashed' => (strlen($user->password) > 20),
                'status' => ($passwordCheck || $directMatch) ? 'success' : 'error',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in password check', ['exception' => $e->getMessage()]);
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }
}
