<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $tryouts = Tryout::all();
        $categories = Category::all();
        
        if ($request->ajax()) {
            $html = view('admin.partials.dashboard', compact('tryouts', 'categories'))->render();
            return response()->json(['html' => $html], 200);
        }

        return view('admin.dashboard', compact('tryouts', 'categories'));
    }
}
