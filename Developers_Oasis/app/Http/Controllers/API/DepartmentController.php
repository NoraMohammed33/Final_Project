<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Service;
use App\Models\Expert;
use Illuminate\Http\Request;
use App\Http\Resources\DepartmentResource;
use App\Http\Requests\StoreDepartmentRequest;
use Exception;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $department = new Department();
        $department->name = $request->input('name');
        $department->description = $request->input('description');
        $department->save();

        return response()->json(['message' => 'Department created successfully'], 201);
    }

    public function show($id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $department = Department::findOrFail($id);
        $department->name = $request->input('name');
        $department->description = $request->input('description');
        $department->save();

        return response()->json(['message' => 'Department updated successfully']);
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json(['message' => 'Department deleted successfully']);
    }

    public function explore($id)
    {
        $department = Department::findOrFail($id);
        $experts = Expert::where('dept_id', $id)->with('department', 'user')->get();
        return response()->json(['department' => $department, 'experts' => $experts]);
    }
}
