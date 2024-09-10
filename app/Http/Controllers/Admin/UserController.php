<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("admin.user.list", compact("users"));
    }

    public function create()
    {
        return view("admin.user.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required",
            "email"=> "required|unique:users|email",
            "password"=> "required|min:6|max:16",
            "confirm" => "required|same:password",
            "is_admin" => "required",
        ]);

        User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> bcrypt($request->password),
            "is_admin" => $request->is_admin,
         ]);
        
         return redirect()->route('admin.user.index')->with('success','Create Successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=> "required",
            "is_admin" => "required",
        ]);

        $data = [
            "name"=> $request->name,
            "is_admin" => $request->is_admin,
        ];

        if ($request->password || $request->confirm) 
        {
            $request->validate([
                "password" => "required|min:6|max:16",
                "confirm" => "required|same:password",
            ]);

            $data['password'] = bcrypt($request->password);
        }

        User::find($id)->update($data);

        return redirect()->route("admin.user.index")->with("success","Update Successfully");
    }

    public function delete($id)
    {
        User::find($id)->delete();

        return redirect()->route("admin.user.index")->with("success","Delete Successfully");
    }
}
