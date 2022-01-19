<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PhoneVerifyController extends Controller
{
    //
    public function verify(){
        return view('auth.verify');
    }
    
    public function verifySubmit(Request $request){
      $user = Auth::user();
      if($user->code==$request->code){
            $user->isverified=1;
            $user->save();
            
        }
    
        return redirect("/home");
    }
}

