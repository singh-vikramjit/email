<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Hash;
use Redirect;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function __construct()
    {
        //
    }

    public function admin_login(Request $request)
    {
        if ($request->isMethod('post')) {

            if($request->has('_token') && count($request->all()) > 1) {
            
                $validator =  Validator::make($request->all(), [
                    'email' => 'required|max:255',
                    'password' => 'required'
                ]);

                if ($validator->fails()) {
                    return redirect('admin')->withErrors($validator)->withInput();
                }

                $data = User::whereEmail($request->email)
                            ->whereType(User::ADMIN_TYPE)
                            ->first();

                if(empty($data) ){
                   $error['email'] = "Please enter the valid Credentials";
                   return Redirect::back()->withErrors($error);
                }

                if(!Hash::check($request->password, $data->password)){
                    $error['password'] = "Please cheeck your password";
                    return Redirect::back()->withErrors($error);
                }

                if (!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password ]) ){
                    $error['error'] = "Please enter the valid Credentials";
                    return Redirect::back()->withErrors($error);
                }
                
                return redirect('admin/dashboard');
            }
        }

        return view('pages.admin.login');
    }

    public function admin_logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('admin/');
    }

    public function admin_dashboard(Request $request)
    {
        return view('pages.admin.dashboard');
    }

    public function admin_users()
    {
        $users = User::all()->toArray();
        return view('pages.admin.users_list' , [ 'users' => $users ] );
    }

}