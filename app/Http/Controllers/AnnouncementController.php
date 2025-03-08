<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Tryout;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function loadAnnouncements(Request $request)
    {
        $announcements = Announcement::all();
        $tryouts = Tryout::all();
        $categories = Category::all();

        if ($request->ajax()) {
            $html = view('admin.partials.announcements', compact('announcements', 'tryouts', 'categories'))->render();
            return response()->json(['html' => $html], 200);
        }

        return view('admin.announcements', compact('announcements', 'tryouts', 'categories'));
    }

    public function addAnnouncement(Request $request)
    {
        // Cek session admin manual
        if (!$request->session()->has('admin_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login dulu!',
                'type' => 'error',
            ], 401);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        sleep(2);

        $announcement = new Announcement();
        $announcement->title = $request->input('title');
        $announcement->message = $request->input('message');
        $announcement->created_by = $request->session()->get('admin_id');
        $announcement->save();

        $creatorName = Admin::find($request->session()->get('admin_id'))->name ?? 'Unknown';

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil ditambahkan!',
            'type' => 'success',
            'data' => [
                'id' => $announcement->id,
                'title' => $announcement->title,
                'message' => $announcement->message,
                'created_by' => $creatorName,
                'is_active' => $announcement->is_active,
            ],
        ]);
    }

    public function updateAnnouncement(Request $request, $id)
    {
        // Cek session admin manual
        if (!$request->session()->has('admin_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login dulu!',
                'type' => 'error',
            ], 401);
        }

        $announcement = Announcement::find($id);
        if ($announcement) {
            $announcement->title = $request->input('title');
            $announcement->message = $request->input('message');
            $announcement->save();

            return response()->json([
                'success' => true,
                'message' => 'Pengumuman berhasil diperbarui!',
                'type' => 'success',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pengumuman tidak ditemukan!',
            'type' => 'error',
        ], 404);
    }

    public function deleteAnnouncement($id)
    {
        // Cek session admin manual
        if (!request()->session()->has('admin_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login dulu!',
                'type' => 'error',
            ], 401);
        }

        $announcement = Announcement::find($id);
        if ($announcement) {
            $announcement->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengumuman berhasil dihapus!',
                'type' => 'success',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pengumuman tidak ditemukan!',
            'type' => 'error',
        ], 404);
    }

    public function toggleAnnouncement($id)
    {
        // Cek session admin manual
        if (!request()->session()->has('admin_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login dulu!',
                'type' => 'error',
            ], 401);
        }

        $announcement = Announcement::find($id);
        if ($announcement) {
            $announcement->is_active = !$announcement->is_active;
            $announcement->save();

            return response()->json([
                'success' => true,
                'message' => 'Status pengumuman berhasil diubah!',
                'type' => 'success',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pengumuman tidak ditemukan!',
            'type' => 'error',
        ], 404);
    }
}