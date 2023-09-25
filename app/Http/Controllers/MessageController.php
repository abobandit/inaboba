<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return MessageResource::collection(Message::all());
    }

    public function store(MessageRequest $request)
    {
        try {
            $message = Message::create($request->validated());
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
