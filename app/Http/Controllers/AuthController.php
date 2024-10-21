<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    public function login_index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try 
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            // Attempt to log the user in
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                return redirect()->intended(route('families.index'));
            }

            return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
        catch(Exception $ex)
        {
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register_index()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        try 
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
        
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            // We only create users with the role `user` on registering 
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => Role::where('name', 'user')->first()->id,
            ]);
        
            // Log the user in
            Auth::login($user);
        
            return redirect()->route('families.index');
        }
        catch(Exception $ex)
        {
            return redirect()->back();
        }
    }
}
