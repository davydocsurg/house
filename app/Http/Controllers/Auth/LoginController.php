<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
//use App\User;
use Auth;
use App\Validation\RegisterRequest;
use Illuminate\Support\Facades\Config;

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
    protected $redirectTo ='/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:agent')->except('logout');
    }

     /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdminLoginForm()
    {
        return view('auth.login', [
            'url' => Config::get('constants.guards.admin')
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAgentLoginForm()
    {
        return view('auth.login', [
            'url' => Config::get('constants.guards.agent')
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);
    }

    /**
     * @param Request $request
     * @param $guard
     * @return bool
     */
    protected function guardLogin(Request $request, $guard)
    {
        $this->validator($request);

        return Auth::guard($guard)->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminLogin(Request $request)
    {
        if ($this->guardLogin($request, Config::get('constants.guards.admin'))) {
            return redirect()->intended('/admin');
        }

        return back()->withInput($request->only('email', 'remember'));
    }



    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function agentLogin(Request $request)
    {
        if ($this->guardLogin($request,Config::get('constants.guards.agent'))) {
            return redirect()->intended('/agent');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
}
