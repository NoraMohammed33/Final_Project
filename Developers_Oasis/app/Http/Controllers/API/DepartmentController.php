<?php

namespace App\Http\Controllers\API;

use App\Models\Department;
use App\Models\Expert;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\HTTP\Controllers\controller;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    
    public function index()
    {
        $departments = Deprtment::all();
        return response()->json($departments);
        // return DepartmentResource::collection(Department::all());
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->all());
        return new  DepartmentResource($department);
    }

    public function show(Department $department)
    {

    }
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        //
        if ($department)
            try {
                $department->update($request->all());
                return new DepartmentResource($department);
            } catch (Exception $e) {
                return $e;
            }
        else {
            return response('', 404);
        }
    }
    public function destroy(Department $department)
    {
        if ($deprtment) {
            try {
                $deprtment->delete();
                return new Response('', 204);
            } catch (Exception $e) {
                return $e;
            }
        } else {
            return response()->json('', 404);
        }
    }
}






