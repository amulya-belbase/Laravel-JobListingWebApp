<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create(){
        return view('users.register');
    }

    // store user information
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // hashing password
        $formFields['password'] = bcrypt($formFields['password']);

        // create user
        $user = User::create($formFields);
        
        //Login
        auth()->login($user);
        return redirect('/')->with('message','User created and Logged In');

    }

    // Logout
    public function logout(Request $request){
        // loggin out the user
        auth()->logout();

        // invalidating the session and regenerating the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','User Logged Out');

    }

    // Show Login Form
    public function login(){
        return view('users.login');
    }

    // Authenticate user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','User Logged In');
        }

        return back()->withErrors(['email' => 'Invalid Login'])->onlyInput('email');
    }
}
