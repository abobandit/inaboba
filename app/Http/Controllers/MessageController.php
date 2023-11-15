<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return MessageResource::collection(Message::all());
    }
   /* public function send(Request $request){
        $user = Auth::user();
    }*/
    public function store(MessageRequest $request)
    {
        try {
            $message = Message::create($request->validated());
            MessageSent::dispatch($request->text,Auth::user());
            return response()->json([
                'status' => true,
                'message' => $message
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
    public function showLastMessage()
    {
        $findMessage = new MessageResource();

        return response()->json([
            'status' => true,
            'data'=>$findMessage
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
