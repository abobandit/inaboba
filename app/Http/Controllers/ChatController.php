<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\ChatRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use App\Models\UserChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function __construct()

    {

        $this->middleware('auth');

    }
    public function index()
    {
        // $userId = auth()->id();

        // $chats = DB::table('chats')
        //     ->select('chats.id as chat_id', 'chats.title as chat_name', 'messages.text as last_message', 'messages.created_at as last_message_time')
        //     ->leftJoin('user_chat', 'chats.id', '=', 'user_chat.chat_id')
        //     ->leftJoin('messages', function ($join) {
        //         $join->on('user_chat.id', '=', 'messages.user_chat_id')
        //              ->whereRaw('messages.id = (select max(id) from messages where user_chat_id = user_chat.id)');
        //     })
        //     ->where('user_chat.user_id', $userId)
        //     ->orderBy('last_message_time', 'desc')
        //     ->get();

        // return response()->json($chats);

        // $userId = auth()->id();

        // // Получаем все чаты, в которых участвует пользователь
        // $userChats = UserChat::where('user_id', $userId)->pluck('chat_id');

        // // Получаем последние сообщения для каждого чата
        // $lastMessages = Message::whereIn('user_chat_id', function($query) use ($userChats) {
        //     $query->select('id')->from('user_chat')->whereIn('chat_id', $userChats);
        // })->latest()->get()->groupBy('user_chat_id');

        // // Получаем все чаты и их последние сообщения
        // $chats = Chat::whereIn('id', $userChats)->get();

        // $chatsWithLastMessages = $chats->map(function ($chat) use ($lastMessages) {
        //     // $lastMessage = $lastMessages[$chat->id] ?? null;
        //        $lastMessage = $lastMessages[$chat->id] ?? null;
        //     $chat->last_message = $lastMessage;
        //     return $chat;
        // });

        // return ChatResource::collection($chatsWithLastMessages);

        // $userId = auth()->id();

        // // Получаем все чаты, в которых участвует пользователь
        // $userChats = UserChat::where('user_id', $userId)->pluck('chat_id');

        // // Получаем последние сообщения для каждого чата
        // $lastMessages = Message::whereIn('user_chat_id', function($query) use ($userChats) {
        //     $query->select('id')->from('user_chat')->whereIn('chat_id', $userChats);
        // })->latest()->get()->groupBy('user_chat_id');

        // // Получаем все чаты и их последние сообщения
        // $chats = Chat::whereIn('id', $userChats)->get();

        // return ChatResource::collection($chats)->additional([
        //     'last_messages' => $lastMessages->map(function ($messages) {
        //         return $messages->first();
        //     })->map(function ($message) {
        //         return [
        //             'id' => $message->id,
        //             'text' => $message->text,
        //             // Другие поля последнего сообщения
        //         ];
        //     }),
        // ]);
        // $userId = auth()->id();

        // // Получаем все чаты, в которых участвует пользователь
        // $chats = Chat::whereHas('userChat', function($query) use ($userId) {
        //     $query->where('user_id', $userId);
        // })->with(['messages' => function($query) {
        //     $query->latest()->take(1); // Получаем последнее сообщение в каждом чате
        // }])->get();

        // return ChatResource::collection($chats);
        // $user = Auth::user();

        // $chats = $user->chats()->get()->map(function ($chat) use($user) {
        //     return [
        //         'id' => $chat->id,
        //         'title' => $chat->title,
        //         'isPrivate' => $chat->isPrivate,
        //         'lastMessage' => Message::where('user_chat_id', UserChat::where([['user_id', $user->id],['chat_id', $chat->id]])->first()->id)->get()->last(),
        //     ];
        // });

        // return response()->json($chats);

    }

    public function getAllChatsForUser()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $chatsForUser = $user->chats()->get();

        return ChatResource::collection($chatsForUser);
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
