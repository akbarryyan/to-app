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

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
