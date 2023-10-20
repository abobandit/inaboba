<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Album;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;

class PostController extends Controller
{
    public function index()
    {
        return [
            'status' => true,
            'data' => PostResource::collection(Post::all())
        ];
    }

    public function store(PostRequest $postRequest, string $media_id = null) // Задумка, сразу же создать запись о картинке в бд и запихнуть ее в альбом, нуждется в дебаге, не тестилась
    {
        //TODO сделай тут ченить, чтоб работало, а то это косяк полный
        //TODO вроде переделал, но если будут косяки, то вернись сюда
        try {
            $post = Post::create(['user_id' => Auth::id()] + $postRequest->validated());
            if ($media_id) {
                $media = Media::find($media_id);
                $post->media()->attach($media);
            }
            return response()->json([
                'status' => true,
                'post' => $post
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function show(Post $post)
    {
        $findPost = new PostResource($post);
        return response()->json([
            'status' => true,
            'data' => $findPost
        ]);
    }

    public function update(Post $post, request $request)
    {
        $post->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'post successfully updated',
            'data' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json();
    }
}
