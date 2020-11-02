<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Sentinel;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        return view('backend.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
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
        if($user){
            session()->flash('success_msg','User Created Successfully');
            return redirect()->action('User\UserController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('User\UserController@index');
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email'    => 'required|email|max:255',
            'password' => 'confirmed',
        ]);
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        if($user->save())
        {
            $request->session()->flash('success_msg','User Updated Successfully.');
            return redirect()->action('User\UserController@index');
        }else{
            $request->session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('User\UserController@index');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->delete())
        {
            session()->flash('success_msg','User Deleted Successfully');
            return redirect()->action('User\UserController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('User\UserController@index');
        }
    }
}
