<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('user')->get();
        return view('Pages.Questions.browse', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pages.Questions.create_question');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
        ]);
        $question = Question::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('questions.show', $question)->with('success', 'Question created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return view('Pages.Questions.questions', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('Pages.Questions.edit_question', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
        ]);
        $question->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return redirect()->route('questions.show', $question)->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        Question::destroy($question->id);
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.index');
        }
        return redirect()->route('profile')->with('success', 'Question deleted successfully.');
    }
}
