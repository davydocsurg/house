<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    // public function VerifyEmail($token = null)
    // {
    // 	if($token == null) {

    // 		session()->flash('message', 'Invalid Login attempt');

    // 		return redirect()->route('login');

    // 	}

    //    $user = User::where('email_verification_token',$token)->first();

    //    if($user == null ){

    //    	session()->flash('message', 'Invalid Login attempt');

    //     return redirect()->route('login');

    //    }

    //    $user->update([
        
    //     'email_verified' => 1,
    //     'email_verified_at' => Carbon::now(),
    //     'email_verification_token' => ''

    //    ]);
       
    //    	session()->flash('message', 'Your account is activated, you can log in now');

    //     return redirect()->route('login');

    //    }
}
