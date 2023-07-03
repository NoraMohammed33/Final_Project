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
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $searchInput = $request->input('search');

        $postsQuery = $searchInput
            ? Post::where('title', 'like', '%' . $searchInput . '%')
            ->orWhere('body', 'like', '%' . $searchInput . '%')
            : Post::query();

        $posts = $postsQuery->paginate(5);

        return response()->json([
            "status" => 'success',
            'message' => 'Posts fetched successfully.',
            'posts' => $posts,
            'loggeduser' => $user
        ]);
    }


    public function store(StorePostRequest $request)
    {
        $post = new Post($request->all());
        $post->user_id = auth()->user()->getAuthIdentifier();
        $post->save();

        return response()->json([
            'data' => [
                'post' => $post,
            ],
        ]);
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
        $user = Auth::user();

        if ($user->id !== $post->user_id) {

            abort(403, 'You are not authorized to delete this post.');
        }
        try {

            $post->update($request->all());

            return response()->json([
                'data' => [
                    'post' => $post,
                    'user' => $user,
                ],
            ]);
        } catch (Exception $e) {

            return $e;
        }
    }

    public function destroy(Post $post)
    {
        $user = Auth::user();

        if ($user->id !== $post->user_id) {

            abort(403, 'You are not authorized to delete this post.');
        }
        try {

            $post->delete();
            return Response()->json([
                'user' => $user,
            ]);
        } catch (Exception $e) {
            return $e;
        }
    }
    public function explore($id)
    {
        $post = Post::findOrFail($id);
        return response()->json([
            'data' => [
                'post' => $post,
            ],
        ]);
    }
}
