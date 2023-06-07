<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = Expert::all();
        return view('experts.index', compact('experts'));
    }

    public function create()
    {
        // Show the form to create a new expert
    }

    public function store(Request $request)
    {
        // Validate and store the new expert
    }

    public function show(Expert $expert)
    {
        return view('experts.show', compact('expert'));
    }

    public function edit(Expert $expert)
    {
        return view('experts.edit', compact('expert'));
    }

    public function update(Request $request, Expert $expert)
    {
        // Validate and update the expert
    }

    public function destroy(Expert $expert)
    {
        $expert->delete();
        return redirect()->route('experts.index');
    }
}
