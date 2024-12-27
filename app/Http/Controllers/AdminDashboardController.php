<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Anda bisa menambahkan logika tambahan di sini jika diperlukan
        return view('admin.dashboard');
    }
}
