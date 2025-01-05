<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $html = view('admin.partials.dashboard')->render();
            return response()->json(['html' => $html], 200);
        }

        return view('admin.dashboard');
    }
}
