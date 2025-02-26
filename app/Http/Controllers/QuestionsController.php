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

        sleep(2); // Delay to show loading spinner
        
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

    public function update(Request $request, $id)
    {
        $question = Questions::find($id);
        if ($question) {
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

            $question->category_id = $request->input('category_id');
            $question->question_type = $request->input('question_type');
            if ($request->question_type == 'text') {
                $question->question_text = $request->input('question_text');
                $question->question_image = null;
            } else {
                if ($request->hasFile('question_image')) {
                    $file = $request->file('question_image');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads/questions', $filename, 'public');
                    $question->question_image = $filePath;
                    $question->question_text = null;
                }
            }
            $question->option_a = $request->input('option_a');
            $question->option_b = $request->input('option_b');
            $question->option_c = $request->input('option_c');
            $question->option_d = $request->input('option_d');
            $question->correct_answer = $request->input('correct_answer');

            $question->save();

            return response()->json([
                'success' => true,
                'message' => 'Question berhasil diperbarui!',
                'type' => 'success',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Question tidak ditemukan!',
            'type' => 'error',
        ], 404);
    }
}
