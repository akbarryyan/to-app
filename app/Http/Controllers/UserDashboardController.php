<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $html = view('user.partials.dashboard')->render();
            return response()->json(['html' => $html], 200);
        }

        return view('user.dashboard');
    }
}
