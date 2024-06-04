<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use App\Models\UserChat;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
   
    public function getMessagesForChat($chatId)
    {     
            $messages = Message::whereHas('userChat', function ($query) use ($chatId) {
                $query->where('chat_id', $chatId);
            })->get();
    
            return MessageResource::collection($messages);
    }
   /* public function send(Request $request){
        $user = Auth::user();
    }*/
    public function store(Request $request)
    {
        try {
            $userChat = UserChat::where([['chat_id',$request->chat_id],['user_id',Auth::id()]])->first();

            
            $message = Message::create([
                'text'=>$request->text,
                'user_chat_id'=>$userChat->id
            ]);


            event(new MessageSent($message,Auth::user(),$userChat->chat_id));

            return response()->json([
                'status' => true,
                'message' =>$message
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
    public function show(Message $message)
    {
        $findMessage = new MessageResource($message);

        return response()->json([
            'status' => true,
            'data'=>$findMessage
        ]);
    }
    public function showLastMessage(Request $request)
    {
        $message = Message::max('id');
        $chatId = $request->id;
        $lastMessage = Message::whereHas('userChat', function ($query) use ($chatId) {
            $query->where('chat_id', $chatId);
        })
            ->latest()
            ->first();
//        $findUserChat = UserChat::where('chat_id',$request->id)->first();
//        $id = $findUserChat->chat_id;
//        $chat = new ChatResource(Chat::find($id));
//        $findMessage = new MessageResource(Message::find($message)->where());

        return response()->json([
            'status' => true,
            'data'=>$lastMessage,

        ]);
    }

    public function update(Message $message, MessageRequest $request)
    {
        $message->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'message successfully updated',
            'data'=>$message
        ]);
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json([
            'status' => true,
            'message' => 'message successfully deleted'
        ]);
    }
}
