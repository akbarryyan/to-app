<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Tryout;

class CategoriesController extends Controller
{
    public function loadManageCategories(Request $request)
    {
        $categories = Category::all();

        if ($request->ajax()) {
            $html = view('admin.partials.manage-categories', compact('categories'))->render();
            return response()->json(['html' => $html], 200);
        }

        return view('admin.manage-categories', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'tryout_id' => 'required|exists:tryouts,id',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->duration = $request->input('duration');
        $category->tryout_id = $request->input('tryout_id');
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category berhasil ditambahkan!',
            'data' => $category,
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration' => 'required|integer|min:1',
                'tryout_id' => 'required|exists:tryouts,id',
            ]);

            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->duration = $request->input('duration');
            $category->tryout_id = $request->input('tryout_id');
            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Category berhasil diperbarui!',
                'data' => $category,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Category tidak ditemukan!',
        ], 404);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category berhasil dihapus!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Category tidak ditemukan!',
        ], 404);
    }
}
