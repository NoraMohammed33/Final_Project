<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Service;
use App\Models\Expert;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use Exception;

class UserController extends Controller
{
    
    public function index()
    {
        return UserResource::collection(User::all());
    }
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        return new  UserResource($user);
    }
    public function show(User $user)
    {
        if ($user) {
            return new UserResource($user);
        }
        return response('', 404);
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user)
            try {
                $user->update($request->all());
                return new UserResource($user);
            } catch (Exception $e) {
                return $e;
            }
        else {
            return response('', 404);
        }
    }
    public function destroy(User $user)
    {
        if ($user) {
            try {
                $user->delete();
                return new Response('', 204);
            } catch (Exception $e) {
                return $e;
            }
        } else {
            return response()->json('', 404);
        }
    }
}


