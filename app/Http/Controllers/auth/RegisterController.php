<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //register page view ==============================================
    public function view()
    {
        return view('auth.register');
    }

    //register a new account ==========================================
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ]);

        return redirect()->route('index')->with('status', 'Account has been successfully created.');
    }

}
