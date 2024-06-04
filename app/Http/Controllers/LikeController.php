<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LikeController extends Controller
{
    public function index(Post $post)
    {
        $likes = Like::where('post_id', $post)->count();
        return $this->dataResponse($likes, 200);
    }
    public function store(Request $request)
    {
        try{
            $like = Like::create([
                'user_id' => Auth::id(),
                'post_id' => $request->post_id
            ]);
            return $this->dataResponse($like, 201);
        }catch (\Throwable $e){
            return $this->dataResponse($e->getMessage(), 400);
        }    
    }
    public function delete (Like $like)
    {
        $findLike =Like::find($like);
        if ($findLike){
            $findLike->delete();
            return $this->dataResponse($findLike, 200);
        }else {
            return $this->dataResponse('не удалось найти', 404);
        }
    }
}
