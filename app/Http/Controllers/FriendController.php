<?php

namespace App\Http\Controllers;

use App\Http\Requests\FriendRequest;
use App\Http\Resources\FriendResource;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Friend::usersFriends();
        return response()->json([
            'status' => true,
            'data' => FriendResource::collection($friends)
        ]);
    }
    public function pendingFriends(){
        try{
            $friend = Friend::where([['status','pending'],['user_id',Auth::id()]])->get();
            return response()->json([
                'status' => true,
                'data' => FriendResource::collection($friend)
            ]);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
    public function store(Request $request)
    {
        try {
            $friend = Friend::create([
                'friend_id' => $request->friend_id,
                'user_id' => Auth::user()->id
            ]);
            return response()->json([
                'status' => true,
                // 'friend_id' => $request->friend_id,
                    // 'user_id' => Auth::user()->id
                'data' => FriendResource::collection($friend),
                'state'=>'pending'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function show(Friend $friend)
    {
        $findFriend = new FriendResource($friend);

        return response()->json([
            'status' => true,
            'data' => $findFriend
        ]);
    }

    public function update(Friend $friend, string $status)
    {
        $friend->update(['status' => $status]);
        if ($status === 'decline') return response()->json([
            'status' => true,
            'message' => 'friend request was declined',
            'data' => $friend
        ]);
        elseif ($status === 'accepted') {
            $newFriend = Friend::create([
                'friend_id' => $friend,
                'user_id' => Auth::user()->id,
                'status' => $status
            ]);
            return response()->json([
            'status' => true,
            'message' => 'friend request was accepted',
            'data' => [
                'friend' => new FriendResource($friend) ,
                'newFriend' => new FriendResource($newFriend)
                ]
        ]);
    }
    }

    public function destroy(Friend $friend)
    {
        $friend->delete();
        return response()->json([
            'status' => true,
            'message' => 'friend successfully deleted'
        ]);
    }

}
