<?php

namespace App\Http\Controllers\API;

use App\Models\Expert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ExpertResource;
use App\Models\User;

class ExpertController extends Controller
{
    public function profile(Request $request)
    {
        $expert = Expert::where('user_id', $request->user()->id)->first();
        return $expert;
    }
    public function index()
    {
        $experts = Expert::with('department', 'user')->get();
        return response()->json($experts);
    }

    public function create()
    {
        // Show the form to create a new expert
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $expert = Expert::create([
            'dept_id' => $request->input('dept_id'),
            'bio' => $request->input('bio'),
            'user_id' => $user->id,
        ]);

        return response()->json($expert, 201);
    }

    public function show($id)
    {
        $expert = Expert::with('user', 'department')->findOrFail($id);
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
