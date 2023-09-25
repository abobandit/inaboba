<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        return [
            'status' => true,
            'data' => CommentResource::collection(Comment::all())
        ];
    }
    public function store(CommentRequest $request){
        try {
            $validated = $request->validated();
            $comment = Comment::create($validated);
            return response()->json([
                'status' => true,
                'album' => $comment
            ]);
        }catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],400);
        }
    }
    public function show(Comment $comment){
        $findComment = new CommentResource($comment);
        return response()->json([
            'status' => true,
            'data' => $findComment
        ]);
    }
    public function update(Comment $comment, CommentRequest $request)
    {
        $comment->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'comment successfully updated',
            'data'=>$comment
        ]);
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'status' => true,
            'message' => 'comment successfully deleted'
        ]);
    }
}
