<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function redirectPath()
    {
        if (property_exists($this, 'redirectPath'))
        {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
    
    protected function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : 'login';
    }
    
    public function getLogin()
    {
        return view('login-layout');
    }
    
    public function postLogin(Request $request)
    {
        
        if($request) { 
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
                return redirect()->intended($this->redirectPath());
            }
        }
        
        return redirect($this->loginPath())->withErrors([
            'msg' => 'These credentials do not match our records.',
        ]);
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
