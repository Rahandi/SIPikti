<?php

namespace App\Http\Controllers;

use Hash;

use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('user.index', ['data' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.index');
    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('user.edit', ['data' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->username;
        $user->save();

        return redirect()->route('user.index');
    }

    public function editPassword(Request $request)
    {
        $user = User::find($request->id);
        return view('user.edit_password', ['data' => $user]);
    }

    public function updatePassword(Request $request)
    {
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.index');
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        return redirect()->route('user.index');
    }
}
