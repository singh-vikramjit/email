<?php

namespace App\Http\Controllers\Auth;

use Hash;
use Redirect;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    }


    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            if($request->has('_token') && count($request->all()) > 1) {
            
                $validator =  Validator::make($request->all(), [
                    'email' => 'required|max:255',
                    'password' => 'required'
                ]);

                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }

                $data = User::whereEmail($request->email)
                        ->whereType(User::USER_TYPE)
                        ->first();
                        
                if(empty($data) ){
                   $error['email'] = "Please enter the valid Credentials";
                   return Redirect::back()->withErrors($error);
                }
                
                if(!Hash::check($request->password, $data->password)){
                    $error['password'] = "Please cheeck your password";
                    return Redirect::back()->withErrors($error);
                }

                if (!Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password ]) ){
                    $error['error'] = "Please enter the valid Credentials";
                    return Redirect::back()->withErrors($error);
                }
                    
                return redirect('/home');
            }
        }
        
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        return redirect('/login');
    }

}
