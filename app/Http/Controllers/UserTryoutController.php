<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tryout;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserTryoutController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $user = User::find($request->session()->get('user_id'));
        if (!$user) {
            Log::error('User not found for ID: ' . $request->session()->get('user_id'));
            return redirect()->route('user.login');
        }

        $tryouts = Tryout::where('start_date', '<=', now())
                         ->where('end_date', '>=', now())
                         ->get();

        return view('user.tryout', compact('user', 'tryouts'));
    }

    public function register(Request $request, $tryout_id)
    {
        if (!$request->session()->has('user_id')) {
            return response()->json(['message' => 'Harap login terlebih dahulu!'], 401);
        }

        $userId = $request->session()->get('user_id');
        Log::info('User ID from session: ' . $userId);

        $user = User::find($userId);
        if (!$user) {
            Log::error('User not found for ID: ' . $userId);
            return response()->json(['message' => 'User tidak ditemukan!'], 404);
        }

        Log::info('User found: ' . $user->id);

        $tryout = Tryout::findOrFail($tryout_id);

        $tryouts = $user->tryouts;
        Log::info('User tryouts: ' . ($tryouts ? $tryouts->pluck('id')->toJson() : 'null'));

        if ($tryouts && $tryouts->contains($tryout->id)) {
            return response()->json(['message' => 'Anda sudah mendaftar tryout ini!'], 400);
        }

        $user->tryouts()->attach($tryout->id, [
            'registered_at' => now(),
            'status' => 'registered',
        ]);

        return response()->json(['message' => 'Berhasil mendaftar tryout!'], 200);
    }
}