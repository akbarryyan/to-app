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

            return response()->json([
                'success' => true,
                'message' => 'Data pengguna berhasil diperbarui!',
                'type' => 'success', // Untuk toastr
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pengguna tidak ditemukan!',
            'type' => 'error', // Untuk toastr
        ], 404);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengguna berhasil dihapus!',
                'type' => 'success',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pengguna tidak ditemukan!',
            'type' => 'error',
        ], 404);
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil ditambahkan!',
            'type' => 'success', // Untuk toastr
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
}
