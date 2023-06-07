<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use Exception;
use Illuminate\Http\Response;


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
        if($comment)
        try {
            $comment->update($request->all());
            return new CommentResource($comment);

        }catch(Exception $e ){
            return $e;
        }else{
            return response('', 404);
        }
    }

    public function destroy(Comment $comment)
    {
        if($comment){
            try{
                $comment->delete();
                return new Response('', 204);
            }catch(Exception $e){
                return $e;

            }
        }else{
            return response()->json('', 404);
        }

    }
    }

