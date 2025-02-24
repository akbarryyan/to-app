<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $tryouts = Tryout::all();
        if ($request->ajax()) {
            $html = view('admin.partials.dashboard', compact('tryouts'))->render();
            return response()->json(['html' => $html], 200);
        }

        return view('admin.dashboard', compact('tryouts'));
    }
}
