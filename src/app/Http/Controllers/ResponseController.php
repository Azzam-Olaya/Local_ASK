<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request,$questionId)
    {
        $request->validate([
            'body' => 'required|string|min:5'
        ]);
        Response::create([
            'body' => $request->body,
            'question_id' => $questionId,
            'user_id' => auth()->id(),
        ]);
        return redirect()->back()->with('success', 'Response added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        Response::destroy($response->id);
        return redirect()->back()->with('success', 'Response deleted successfully.');
    }
}
