<?php

namespace App\Http\Controllers;

use App\Models\Allpassword;
use Illuminate\Http\Request;

class pagesController extends Controller
{
    public function index(){
        if(isset( Auth()->user()->id)){

            $userGpass = Allpassword::orderby('id','desc')->where('user_id', auth()->user()->id)->limit(4)->get();
        }else{
            $userGpass =null;
        }

        return view('pages.index')->with('userGpass',$userGpass);
        // return $userGpass;
    }


    public function login(){
        return view('pages.login');
    }
    public function register(){
        return view('pages.register');
    }
}