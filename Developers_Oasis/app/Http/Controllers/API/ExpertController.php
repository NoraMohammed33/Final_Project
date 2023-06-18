<?php

namespace App\Http\Controllers\API;

use App\Models\Expert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ExpertResource;

class ExpertController extends Controller
{
    public function index()
    {
         $experts = Expert::with('department','user')->get();
         return response()->json($experts);
//        return ExpertResource::collection(Expert::all());
    }

    public function create()
    {
        // Show the form to create a new expert
    }

    public function store(Request $request)
    {
        $expert = Expert::create($request->all());
        return response()->json($expert, 201);
    }

    public function show($id)
    {
        $expert = Expert::findOrFail($id);
        return response()->json($expert);
    }

    public function edit($id)
    {
        $expert = Expert::findOrFail($id);
        return response()->json($expert);
    }

    public function update(Request $request, $id)
    {
        $expert = Expert::findOrFail($id);
        $expert->update($request->all());
        return response()->json($expert);
    }

    public function destroy($id)
    {
        $expert = Expert::findOrFail($id);
        $expert->delete();
        return response()->json(null, 204);
    }
}

