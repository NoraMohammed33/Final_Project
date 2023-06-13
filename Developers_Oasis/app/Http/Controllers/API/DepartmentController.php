<?php

namespace App\Http\Controllers\API;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\HTTP\Controllers\controller;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    
    public function index()
    {
        return DepartmentResource::collection(Department::all());
    }


    public function create()
    {

    }


    public function store(StoreDepartmentRequest $request)
    {

    }


    public function show(Department $department)
    {

    }


    public function edit(Department $department)
    {

    }


    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        //
    }


    public function destroy(Department $department)
    {

    }
}






