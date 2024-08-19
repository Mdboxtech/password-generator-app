<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authenticationController extends Controller
{
    public function authenticate(Request $request){

        $formfield = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $formfield['email'],'password' => $formfield['password']]) || Auth::attempt(['username' => $formfield['email'],'password' => $formfield['password']]) ){
            return redirect('/')->with('success', 'login successful');
        }else{
            return back()->with('error','invalid user!');
        }
    }



    public function create(Request $request){
        // dd($request);
          $formfield = $request->validate([
            'fullname' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed'
        ]);

         $formfield['password'] = bcrypt($formfield['password']);
        $user = User::create($formfield);

        if( $user){
                auth()->login($user);
            return redirect('/')->with('success' . 'login successful');
        }else{
              return back()->with('error', 'error when creating an  account, try again');
        }

    }


    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'logout successful');
    }
}