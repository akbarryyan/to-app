<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Verifikasi admin
        $admin = Admin::where('email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Simpan informasi admin di session
            $request->session()->put('admin_id', $admin->id);
            return response()->json(['message' => 'Login successful'], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        // Hapus informasi admin dari session
        $request->session()->forget('admin_id');

        // Mengirimkan HTML halaman login sebagai respons
        $html = view('admin.login')->render();

        return response()->json([
            'message' => 'Logout successful',
            'html' => $html
        ], 200);
    }
}
