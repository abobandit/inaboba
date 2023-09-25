<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Album;
use App\Models\Photo;
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

    public function store(PostRequest $postRequest, Request $request) // Задумка, сразу же создать запись о картинке в бд и запихнуть ее в альбом, нуждется в дебаге, не тестилась
    {
        //TODO сделай тут ченить, чтоб работало, а то это косяк полный
        try {
            $user = Auth::id();
            $album = Album::where('user_id', $user)
                ->where('title', 'Общий альбом')
                ->first();
            $image = $request->file('image');
            $post = Post::create($postRequest);
            if ($image) {
                $img = PhotoController::class->store([
                    'path' => $request->path,
                    'folder' => $request->folder,
                    'album_id' => $album->id,
                    'title' => $request->title,
                ]);
                dd($img);
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
