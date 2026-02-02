<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_questions' => Question::count(),
            'total_responses' => \App\Models\Response::count()
        ];
        $questions = Question::with('user')->get();
        $users = User::all();
        return view('Pages.Admin.index', compact('questions', 'users', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if ($id === auth()->id()) {
            return back()->with('error', 'You cannot ban yourself!');
        }
        $user = User::findOrFail($id);
        $user->delete();
        
        return back()->with('success', 'User banned successfully.');
    }
}
