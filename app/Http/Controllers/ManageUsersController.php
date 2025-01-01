<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageUsersController extends Controller
{
    public function loadManageUsers(Request $request)
    {
        if ($request->ajax()) {
            // Hanya mengirimkan konten HTML jika permintaan melalui AJAX
            $html = view('admin.partials.manage-users')->render();
            return response()->json(['html' => $html], 200);
        }

        // Mengirimkan seluruh layout dengan konten jika bukan permintaan AJAX
        return view('admin.manage-users');
    }
}
