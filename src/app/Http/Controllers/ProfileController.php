<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $myQuestions = auth()->user()->questions;
        $favorites = Favorite::with('question')->where('user_id', auth()->id())->get();
        return view('Pages.profile', compact('myQuestions', 'favorites'));
    }
}
