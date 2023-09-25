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

        return response()->json([
            'status' => true,
            'data' => FriendResource::collection(Friend::all())
        ]);
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
                'friend' => $friend
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

    public function update(Friend $friend, Request $request)
    {
        $status = $request->status;
        $friend->update(['status' => $status]);
        if ($status === 'decline') return response()->json([
            'status' => true,
            'message' => 'friend request was declined',
            'data' => $friend
        ]);
        elseif ($status === 'accepted') return response()->json([
            'status' => true,
            'message' => 'friend request was accepted',
            'data' => $friend
        ]);
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
