<?php

namespace App\Http\Controllers;

use App\Models\Allpassword;
use Illuminate\Http\Request;

class generatePcontroller extends Controller
{
    public function savePassword(Request $request){



        $Gpassword = new Allpassword();
        $check= Allpassword::where('generated_password', $request->generated_password)->where('user_id', auth()->user()->id)->get();
 if($check->count()<=0){
        $Gpassword->user_id = auth()->user()->id;
        $Gpassword->generated_password = $request->generated_password;
       if($Gpassword->save()){
            return 'saved success';
        }else{
            return 'error while saving please try again';
        }
    }
     else{
            return 'this generated password is already been saved';

     }
}

public function getGpassword(){
        $userGpass = Allpassword::orderby('id','desc')->where('user_id', auth()->user()->id)->limit(4)->get();
        return $userGpass;
}

public function allGpassword(){
        $userGpassword = Allpassword:: orderby('id','desc')->where('user_id', auth()->user()->id)->paginate(10);
        return view('pages.generatedPassword')->with('userGpassword', $userGpassword);
}

public function deleteGpass(Request $request){
$id =$request->id;
        Allpassword::find($id)->delete();
        return back()->with('success', 'delete successful');

}
}