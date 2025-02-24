<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Tryout;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    public function loadManageCategories(Request $request)
    {
        try {
            $categories = Category::with('tryout')->get();
            $tryouts = Tryout::all();

            if ($request->ajax()) {
                $html = view('admin.partials.manage-categories', compact('categories', 'tryouts'))->render();
                return response()->json(['html' => $html], 200);
            }

            return view('admin.manage-categories', compact('categories', 'tryouts'));
        } catch (\Exception $e) {
            Log::error('Error loading manage categories: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memuat data.'], 500);
        }
    }

    public function addCategory(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration' => 'required|integer|min:1',
                'tryout_id' => 'required|exists:tryouts,id',
            ]);

            sleep(2); // Delay to show loading spinner

            $category = Category::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'duration' => $request->input('duration'),
                'tryout_id' => $request->input('tryout_id'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category berhasil ditambahkan!',
                'data' => $category,
            ]);
        } catch (\Exception $e) {
            Log::error('Error adding category: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menambahkan category.'], 500);
        }
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration' => 'required|integer|min:1',
                'tryout_id' => 'required|exists:tryouts,id',
            ]);

            $category->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'duration' => $request->input('duration'),
                'tryout_id' => $request->input('tryout_id'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category berhasil diperbarui!',
                'data' => $category,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui category.'], 500);
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus category.'], 500);
        }
    }
}