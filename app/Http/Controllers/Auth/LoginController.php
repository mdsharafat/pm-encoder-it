<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(\Illuminate\Http\Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (isset($user) && ($user->status == 0)) {
            Session::flash('flashMessage', 'Account deactivated. Please contact with your admin.');
        }
        $credentials = $request->only($this->username(), 'password');
        return Arr::add($credentials, 'status', '1');
    }

    protected function authenticated()
    {
        $role = Auth::user()->roles->first();

        if ($role->name == "Admin") {
            return redirect('/') ;
        } else {
            return redirect('/employee-dashboard');
        }
    }
}
