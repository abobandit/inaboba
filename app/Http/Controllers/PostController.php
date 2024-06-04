<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Album;
use App\Models\Friend;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function index()
    {
        $friends = Friend::usersFriends()->only('id');
        $posts =  DB::select('
        SELECT *
        FROM posts
        WHERE (visibility = "public") OR (visibility = "friend" AND user_id IN (SELECT friend_id FROM friends WHERE user_id = :current_user_id))
    ', ['current_user_id' => Auth::id()]);
        return [    
            'status' => true,
            'data' => PostResource::collection($posts)
        ];
    }
    public function usersPosts(){
        try {
            $posts = Post::all()->where('user_id',Auth::id());
            $postResponse = PostResource::collection($posts);
            return $this->dataResponse($postResponse,200);
        }catch (\Throwable $throwable){
            return $this->dataResponse($throwable, 400,false);
        }

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
            return $this->dataResponse($post, 201);
        } catch (\Throwable $th) {
           return $this->dataResponse($th->getMessage(), 400,false);
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
        try {
            $post->update($request->all());
            return $this->dataResponse($post, 200);
        }catch (\Throwable $throwable){
            return $this->dataResponse($throwable, 400,false);
        }

    }

    public function destroy(Post $post)
    {
        $post->delete();
        return $this->dataResponse('deleted', 200);
    }
}
