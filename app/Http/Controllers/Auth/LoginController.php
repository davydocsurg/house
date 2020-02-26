<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Validation\RegisterRequest;

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
//     use RegisterRequest;

//     public function ShowLoginForm()
//    {
//        return view('authentication.login');
//    }

//    public function HandleLogin(Request $request)
//    {
       
//        $this->loginDataSanitization($request->except(['_token']));

//        $credentials = $request->except(['_token']);

//        $user = User::where('email',$request->email)->first();

//        if($user->email_verified == 1){

//        if (auth()->attempt($credentials)) {

//                 $user = auth()->user();

//                 $user->last_login = Carbon::now();

//                 $user->save();

//                 return redirect()->route('home');

//            }
          
//        }

//        session()->flash('message', 'Invalid Credentials');

//        session()->flash('type', 'danger');

//        return redirect()->back();
//    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
