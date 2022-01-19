<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
//use App\Http\Middleware\PhoneVerification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->user = new User;
    }

    public function login(Request $request)
    {
        // Check validation
        $this->validate($request, [
            'mobile_no' => 'required|regex:/[0-9]{10}/|digits:11',            
        ]);

        // Get user record
        $user = User::where('mobile_no', $request->get('mobile_no'))->first();
        $pass = User::where('password', $request->get('password'))->first();

        // Check Condition Mobile No. Found or Not
        if($request->get('mobile_no') != $user->mobile_no &&  $request->get('password')!=$pass->password ) {
            \Session::put('errors', 'Your mobile number not match in our system..!!');
            return back();
        }        
        
        // Set Auth Details
        \Auth::login($user);
        
        // Redirect home page
        return redirect()->route('home');
    }
}
