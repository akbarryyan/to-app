<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use App\Models\Category;
use App\Models\Questions;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function loadManageQuestions(Request $request)
    {
        $questions = Questions::all();
        $tryouts = Tryout::all();
        $categories = Category::all();

        if ($request->ajax()) {
            $html = view('admin.partials.manage-questions', compact('questions', 'tryouts', 'categories'))->render();
            return response()->json(['html' => $html], 200);
        }

        return view('admin.manage-questions', compact('questions', 'tryouts', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question_type' => 'required|in:text,image',
            'question_text' => 'nullable|string|required_if:question_type,text',
            'question_image' => 'nullable|image|required_if:question_type,image',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $question = new Questions();
        $question->category_id = $request->category_id;
        $question->question_type = $request->question_type;
        if ($request->question_type == 'text') {
            $question->question_text = $request->question_text;
        } else {
            if ($request->hasFile('question_image')) {
                $file = $request->file('question_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/questions', $filename, 'public');
                $question->question_image = $filePath;
            }
        }
        $question->option_a = $request->option_a;
        $question->option_b = $request->option_b;
        $question->option_c = $request->option_c;
        $question->option_d = $request->option_d;
        $question->correct_answer = $request->correct_answer;
        $question->save();

        return response()->json(['message' => 'Question berhasil ditambahkan!'], 200);
    }
}
