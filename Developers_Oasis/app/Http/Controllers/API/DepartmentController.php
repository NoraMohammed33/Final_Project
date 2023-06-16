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
        return DepartmentResource::collection(Department::all());
    }


    public function store(StoreDepartmentRequest $request)
    {
        $post = Post::create($request->all());
        return new  DepartmentResource($post);
    }

    public function show($department)
    {
        if ($department) {
            return new DepartmentResource($department);
        }
        return response('', 404);
    }


    public function update(UpdateDepartmentRequest $request, Department $department)
    {
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
        if ($department) {
            try {
                $department->delete();
                return new Response('', 204);
            } catch (Exception $e) {
                return $e;
            }
        } else {
            return response()->json('', 404);
        }
    }
}
