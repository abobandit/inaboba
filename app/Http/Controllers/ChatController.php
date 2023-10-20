<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\ChatRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {

        return response()->json([
            'status' => true,
            'data' => ChatResource::collection(Chat::all())
        ]);
    }
    public function store(ChatRequest $request)
    {
        // В запросе должен приходить массив из user_id, участников чата, один из user_id это id создавшего чат
        try {
            $isPrivate = count($request->users) === 2;
            $title = $isPrivate ? '' : 'Беседа';
            $chat = Chat::create([
                'isPrivate' => $isPrivate,
                'title' => $title
            ]);
            foreach ($request->users as $item) {
                $user = User::find($item);
                $user->chats()->attach($chat);
            }

            return response()->json([
                'status' => true,
                'chat' => new ChatResource($chat)

            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function show(Chat $chat)
    {
        $findChat = new ChatResource($chat);

        return response()->json([
            'status' => true,
            'data' => $findChat
        ]);
    }

    public function update(Chat $chat, request $request)
    {
        $chat->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Chat successfully updated',
            'data' => $chat
        ]);
    }

    public function destroy(Chat $chat)
    {
        $chat->delete();
        return response()->json([
            'status' => true,
            'message' => 'Chat successfully deleted'
        ]);
    }
}
