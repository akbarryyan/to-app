<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function loadManageQuestions(Request $request)
    {
        $questions = Questions::all();

        if ($request->ajax()) {
            $html = view('admin.partials.manage-questions', compact('questions'))->render();
            return response()->json(['html' => $html], 200);
        }

        return view('admin.manage-questions', compact('questions'));
    }
}
