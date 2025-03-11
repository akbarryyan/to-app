<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $user = User::with('tryouts')->find($request->session()->get('user_id'));
        if (!$user) {
            return redirect()->route('user.login');
        }

        return view('user.dashboard', compact('user'));
    }
}