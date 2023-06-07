<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
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
=======
use App\Http\Requests\StoreExpertRequest;
use App\Http\Requests\UpdateExpertRequest;
use App\Models\Expert;

class ExpertController extends Controller
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
    public function store(StoreExpertRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Expert $expert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expert $expert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpertRequest $request, Expert $expert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expert $expert)
    {
        //
>>>>>>> origin/main
    }
}
