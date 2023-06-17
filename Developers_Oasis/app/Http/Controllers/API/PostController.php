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

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::all());
    }


    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        return new  PostResource($post);
    }

    public function show(Post $post)
    {
        if ($post) {
            return new PostResource($post);
        }
        return response('', 404);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post)
            try {
                $post->update($request->all());
                return new PostResource($post);
            } catch (Exception $e) {

                return $e;
            }
        else {
            return response('', 404);
        }
    }

    public function destroy (Post $post)
    {
        if ($post) {
            try {
                $post->delete();
                return new Response('', 204);
            } catch (Exception $e) {
                return $e;
            }
        } else {
            return response()->json('', 404);
        }
    }

    }
