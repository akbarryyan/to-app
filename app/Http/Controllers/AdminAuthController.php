<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Debug: Cek apa yang diterima dari form
        Log::info('Login attempt', ['email' => $credentials['email'], 'password' => $credentials['password']]);

        $admin = Admin::where('email', $credentials['email'])->first();

        // Debug: Cek apa admin ketemu
        if (!$admin) {
            Log::info('Admin not found for email: ' . $credentials['email']);
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Debug: Cek apa password cocok
        if (!Hash::check($credentials['password'], $admin->password)) {
            Log::info('Password mismatch for email: ' . $credentials['email']);
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Kalau sampai sini, login sukses
        $request->session()->put('admin_id', $admin->id);
        Log::info('Login successful', ['admin_id' => $admin->id]);
        return response()->json(['message' => 'Login successful'], 200);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        $html = view('admin.login')->render();

        return response()->json([
            'message' => 'Logout successful',
            'html' => $html
        ], 200);
    }
}