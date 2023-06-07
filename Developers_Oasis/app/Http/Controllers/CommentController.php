<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{

    public function index()
    {
        return CommentResource::collection(Comment::all());
    }

    public function store(StoreCommentRequest $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
        ]);
        $comment = Comment::create($request->all());
        $comment->save();
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
          $comment->update($request->all());
          return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
