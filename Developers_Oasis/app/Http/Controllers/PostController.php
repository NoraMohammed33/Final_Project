<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use Exception;

class PostController extends Controller
{
    // function __construct()
    // {

    //     $this->middleware('auth:sanctum')->only('create', 'store', 'edit', 'update',);
    // }
    public function index()
    {

    return  PostResource::collection(Post::all());
        // return csrf_token();
    }

    public function create()
    {
        return view('createpost');
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


    public function edit(Post $post)
    {
        if ($post) {
            return view('editpost');
        } else {
            return response('', 404);
        }
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $post->update($request->all());
            return new PostResource($post);

        }catch(Exception $e ){

            return $e;
        }
    }

    public function destroy(Post $post)
    {
        if($post){
            $post->delete();
            return new Response('', 204);
        }else{
            return response()->json('', 404);
        }

    }

}
