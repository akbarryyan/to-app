<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAuthController extends Controller
{
    public function showRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['message' => 'Registrasi berhasil, silakan login!'], 200);
    }

    public function showLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            $request->session()->put('user_id', $user->id);
            return response()->json(['message' => 'Login berhasil!'], 200);
        }

        return response()->json(['message' => 'Email atau password salah!'], 401);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        return redirect()->route('user.login');
    }

    public function showProfile(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.partials.profile');
        }

        $user = User::find($request->session()->get('user_id'));
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return response()->json(['message' => 'Harap login terlebih dahulu!'], 401);
        }

        $request->validate([
            'sekolah_asal' => 'required|string|max:255',
            'jurusan_tujuan' => 'required|string|max:255',
        ]);

        $user = User::find($request->session()->get('user_id'));
        $user->sekolah_asal = $request->input('sekolah_asal');
        $user->jurusan_tujuan = $request->input('jurusan_tujuan');
        $user->save();

        return response()->json(['message' => 'Profile berhasil diperbarui!'], 200);
    }
}