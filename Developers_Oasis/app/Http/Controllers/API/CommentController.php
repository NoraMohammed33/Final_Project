<?php

namespace App\Http\Controllers\API;


use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use Exception;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;


class CommentController extends Controller
{

    function __construct()
    {

        $this->middleware('auth:sanctum')->only('create', 'store', 'edit', 'update','destroy');
    }

    public function index()
    {

    return CommentResource::collection(Comment::all());
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->all());
        $comment->save();
        return new CommentResource($comment);

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

