<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginFixController extends Controller
{
    /**
     * Handle a login request and fix common issues.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::info('Login attempt', ['email' => $request->email]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            Log::warning('Login failed - User not found', ['email' => $request->email]);
            throw ValidationException::withMessages([
                'email' => ['The provided email does not exist.'],
            ]);
        }

        // First try normal login
        $normalLoginAttempt = Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password
        ], $request->boolean('remember'));

        if ($normalLoginAttempt) {
            Log::info('Login successful with normal attempt', ['user_id' => $user->id]);
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        
        // Check if the password might be unhashed or stored differently
        $directMatch = ($request->password === $user->password);
        if ($directMatch) {
            Log::info('Login with direct password match, updating hash', ['user_id' => $user->id]);
            
            // Update the password with a properly hashed version
            $user->password = Hash::make($request->password);
            $user->save();
            
            // Log the user in
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Force a login attempt if needed
        if ($this->shouldForceLogin($user, $request->password)) {
            Log::info('Forcing login after password check', ['user_id' => $user->id]);
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        
        // If we get here, authentication failed
        Log::warning('Login failed - Invalid credentials', [
            'user_id' => $user->id,
            'password_length' => strlen($user->password)
        ]);
        
        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }
    
    /**
     * Check if we should force a login based on additional logic
     */
    private function shouldForceLogin(User $user, string $password): bool
    {
        try {
            // For debugging - get the real hash from the database directly
            $dbPassword = DB::table('users')
                ->where('id', $user->id)
                ->value('password');
                
            Log::debug('Password comparison', [
                'user_id' => $user->id,
                'model_password_length' => strlen($user->password),
                'db_password_length' => strlen($dbPassword),
                'db_vs_model_match' => ($user->password === $dbPassword) ? 'Yes' : 'No'
            ]);
            
            // Try both bcrypt and argon hash checks
            $bcryptCheck = password_verify($password, $user->password);
            
            if ($bcryptCheck) {
                Log::info('Password verified with bcrypt but Auth::attempt failed', [
                    'user_id' => $user->id
                ]);
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            Log::error('Error in shouldForceLogin', ['exception' => $e->getMessage()]);
            return false;
        }
    }
}
