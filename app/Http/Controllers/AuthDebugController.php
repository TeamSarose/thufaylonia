<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthDebugController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->get();
        return view('auth-debug', ['users' => $users]);
    }
    
    public function testLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }
        
        // Test various authentication methods
        $results = [];
        
        // 1. Try direct Auth::attempt
        $authAttempt = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        $results['auth_attempt'] = $authAttempt;
        
        // 2. Check with Hash::check
        $hashCheck = Hash::check($request->password, $user->password);
        $results['hash_check'] = $hashCheck;
        
        // 3. Check with password_verify
        $passwordVerify = password_verify($request->password, $user->password);
        $results['password_verify'] = $passwordVerify;
        
        // 4. Direct comparison (should almost never work unless unhashed)
        $directCompare = ($request->password === $user->password);
        $results['direct_compare'] = $directCompare;
        
        // Get hash algorithm info
        $hashInfo = password_get_info($user->password);
        $results['hash_info'] = $hashInfo;
        
        // Get password length and other details
        $results['password_length'] = strlen($user->password);
        $results['password_algorithm'] = password_get_info($user->password)['algoName'];
        
        // Debug database connection and user retrieval
        try {
            $dbUser = DB::table('users')->where('email', $request->email)->first();
            $results['db_user_found'] = !is_null($dbUser);
            $results['db_password_length'] = $dbUser ? strlen($dbUser->password) : 0;
            $results['model_vs_db_match'] = $dbUser && $user->password === $dbUser->password;
        } catch (\Exception $e) {
            $results['db_error'] = $e->getMessage();
        }
        
        // If any check passes, we can fix authentication
        if ($hashCheck || $passwordVerify || $directCompare) {
            $results['can_fix_auth'] = true;
        } else {
            $results['can_fix_auth'] = false;
        }
        
        return view('auth-debug', [
            'results' => $results,
            'users' => User::select('id', 'name', 'email', 'created_at')->get(),
            'tested_user' => $user
        ]);
    }
    
    public function fixUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'new_password' => 'required|min:8'
        ]);
        
        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        return redirect()->route('auth.debug')
            ->with('success', "User {$user->email} password has been updated. Try logging in now.");
    }
}
