<?php

namespace App\Http\Controllers\API;


use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use Exception;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {

        return CommentResource::collection(Comment::all());
    }

    public function store(StoreCommentRequest $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'post_id' => 'required',
        ]);
        $comment = new Comment($request->all());
        $comment->user_id = auth()->user()->getAuthIdentifier();
        $comment->save();

        return response()->json([
            'data' => [
                'comment' => $comment,
            ],
        ]);
    }

    public function update(UpdateCommentRequest $request, $postId, $commentId)
    {
        $user = Auth::user();

        $comment = Comment::findOrFail($commentId);

        if ($user->id !== $comment->user_id) {

            abort(403, 'You are not authorized to delete this post.');
        }
        try {
            $comment->body = $request->input('body');
            $comment->save();
            return response()->json('Comment updated successfully');
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    public function destroy($postId, $commentId)
    {
        $user = Auth::user();
        $comment = Comment::findOrFail($commentId);
        if ($user->id !== $comment->user_id) {
            abort(403, 'you can not do that!');
        }

        try {
            $comment->delete();
            return response()->json('Comment deleted successfully', 204);
        } catch (Exception $e) {
            return response()->json('Failed to delete comment', 500);
        }
    }
    //========show cmments for spesific posts=======================
    public function commentsForPost($postId)
    {
        $comments = Comment::where('post_id', $postId)->get();
        return CommentResource::collection($comments);
    }
}
//===================================================================
