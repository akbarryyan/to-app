<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use Illuminate\Http\Request;

class TryoutController extends Controller
{
    public function loadManageTryouts(Request $request)
    {
        $tryouts = Tryout::all();

        if ($request->ajax()) {
            $html = view('admin.partials.manage-tryouts', compact('tryouts'))->render();
            return response()->json(['html' => $html], 200);
        }

        return view('admin.manage-tryouts', compact('tryouts'));
    }

    public function updateTryout(Request $request, $id)
    {
        $tryout = Tryout::find($id);
        if ($tryout) {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_date' => 'nullable|date', // Ubah menjadi nullable
                'end_date' => 'nullable|date', // Ubah menjadi nullable
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price' => 'required|numeric|min:0',
                'is_paid' => 'nullable|boolean',
            ]);

            $tryout->name = $request->input('name');
            $tryout->description = $request->input('description');
            $tryout->start_date = $request->input('start_date');
            $tryout->end_date = $request->input('end_date');
            $tryout->price = $request->input('price');
            $tryout->is_paid = $request->has('is_paid');

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/tryouts', 'public');
                $tryout->image = $imagePath;
            }

            $tryout->save();

            return response()->json([
                'success' => true,
                'message' => 'Data tryout berhasil diperbarui!',
                'type' => 'success',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tryout tidak ditemukan!',
            'type' => 'error',
        ], 404);
    }

    public function deleteTryout($id)
    {
        $tryout = Tryout::find($id);
        if ($tryout) {
            $tryout->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tryout berhasil dihapus!',
                'type' => 'success',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tryout tidak ditemukan!',
            'type' => 'error',
        ], 404);
    }

    public function addTryout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date', // Ubah menjadi nullable
            'end_date' => 'nullable|date', // Ubah menjadi nullable
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:0',
            'is_paid' => 'nullable|boolean',
        ]);

        $tryout = new Tryout();
        $tryout->name = $request->input('name');
        $tryout->description = $request->input('description');
        $tryout->start_date = $request->input('start_date');
        $tryout->end_date = $request->input('end_date');
        $tryout->price = $request->input('price');
        $tryout->is_paid = $request->has('is_paid');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/tryouts', 'public');
            $tryout->image = $imagePath;
        }

        $tryout->save();

        return response()->json([
            'success' => true,
            'message' => 'Tryout berhasil ditambahkan!',
            'type' => 'success',
            'data' => [
                'id' => $tryout->id,
                'name' => $tryout->name,
                'description' => $tryout->description,
                'start_date' => $tryout->start_date,
                'end_date' => $tryout->end_date,
                'price' => $tryout->price,
                'is_paid' => $tryout->is_paid,
                'image' => $tryout->image,
            ],
        ]);
    }
}
