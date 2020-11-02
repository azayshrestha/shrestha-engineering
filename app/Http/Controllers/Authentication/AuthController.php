<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Sentinel;
use Session;

class AuthController extends Controller
{

    public function register()
    {
        return view('backend.auth.register');
    }

    public function registerUser(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5',
        ]);
        $credentials = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email'    => $request->email,
            'password' => $request->password,
        ];

        $user = Sentinel::registerAndActivate($credentials);

//        $usr = Sentinel::findById($user->id);
//        if(Sentinel::findRoleBySlug('customer') == Null)
//        {
//            $customer_role = new EloquentRole();
//            $customer_role->slug = 'customer';
//            $customer_role->name = 'Customer';
//            $customer_role->description = 'Can Purchase Anything (Dont Delete this Role)';
//            $customer_role->save();
//        }
//
//        $role = Sentinel::findRoleBySlug('customer');
//        $role->users()->attach($usr);
        Sentinel::authenticate($request->all());
        session(['user_id' => $user->id]);
        return redirect()->action('Authentication\AuthController@login');

    }

    public function login()
    {
        return view('backend.auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',

        ]);

        $users = User::where('email', $request->email)->get();
        if(count($users)>0)
        {
            $user = $users->first();
        }else{
            $request->session()->flash('error_msg', 'E-mail Id or Password is not correct.');
            return redirect()->back();
        }

        if (Sentinel::authenticate($request->all())) {
            session(['user_id' => $user->id]);
            return redirect()->route('dashboard');
        }else{
            $request->session()->flash('error_msg', 'E-mail Id or Password is not correct.');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Sentinel::logout();
        Session::flush();
        return redirect('/');
    }
}
