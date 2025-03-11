<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(Request $request)
{
    if (!$request->session()->has('user_id')) {
        return redirect()->route('user.login');
    }

    $user = User::find($request->session()->get('user_id'));
    return view('user.dashboard', compact('user'));
}
}
