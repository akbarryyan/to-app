<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManageUsersController extends Controller
{
    public function loadManageUsers(Request $request)
    {
        $users = User::all();

        if ($request->ajax()) {
            $html = view('admin.partials.manage-users', compact('users'))->render();
            return response()->json(['html' => $html], 200);
        }

        return view('admin.manage-users', compact('users'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function addUser(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Enkripsi password
        $user->save();
        return response()->json(['id' => $user->id, 'name' => $user->name, 'email' => $user->email]);
    }

}