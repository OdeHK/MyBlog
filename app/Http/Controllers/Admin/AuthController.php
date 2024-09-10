<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view("admin.login.index");
    }

    public function checkLogin(Request $request)
    {
        if (Auth::attempt(["email"=> $request->email, "password" => $request->password]))
        {
            return redirect()->route('admin.post.index');
        }

        return redirect()->route('admin.auth.login')->with('error','Email or password is not correct');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.auth.login');
    }

    public function profile()
    {
        return view('admin.login.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            "name"=> "required",
        ]);

        $data = [
            "name"=> $request->name,
        ];

        if ($request->password || $request->confirm) 
        {
            $request->validate([
                "password" => "required|min:6|max:16",
                "confirm" => "required|same:password",
            ]);

            $data['password'] = bcrypt($request->password);
        }

        Auth::user()->update($data);

        return redirect()->route("admin.user.index")->with("success","Update Successfully");
    }
}
