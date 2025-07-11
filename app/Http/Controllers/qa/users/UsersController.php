<?php

namespace App\Http\Controllers\qa\users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function users()
    {
        $users = User::get();
        return view('qa.users.view', ['users' => $users]);
    }
    public function usersform()
    {
        return view('qa.users.add');
    }
    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'department' => $request->department,
            'designation' => $request->designation,
            'created_at' => now(),
        ]);

        return back()->with('status', 'New User is Successfully Created.');
    }

    public function single($id)
    {
        $user = User::find($id);
        return view('qa.users.single', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('qa.users.update', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'role' => 'required',
        ]);

        $user = User::where('id', $id)->first();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->department = $request->department;
        $user->designation = $request->designation;
        $user->role = $request->role;
        $user->updated_at->now();
        $user->save();
        return back()->with('status', 'User Details Updated Successfully.');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('status', 'User has been  Deleted Successfully.');
    }
}
