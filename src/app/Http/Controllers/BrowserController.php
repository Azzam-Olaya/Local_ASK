<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('Pages.browse', compact('questions'));
    }
}
