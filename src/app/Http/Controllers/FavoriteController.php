<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Question;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('user')->get();
        return view('Pages.favorites', compact('favorites'));
    }
    public function toggle(Question $question) // Laravel finds the Question by ID automatically
    {
        $userId = auth()->id();

        // Check if already favorited
        $favourite = Favorite::where('user_id', $userId)
            ->where('question_id', $question->id)
            ->first();

        if ($favourite) {
            $favourite->delete();
        } else {
            Favorite::create([
                'user_id' => $userId,
                'question_id' => $question->id,
            ]);
        }

        return redirect()->back();
    }
}
