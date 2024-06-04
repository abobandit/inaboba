<?php

namespace App\Http\Resources;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'isPrivate' => $this->isPrivate,
            'last_message' => $this->when(isset($this->last_message), function () {
                return [
                    'id' => $this->last_message['id'],
                    'text' => $this->last_message['text'],
                    // Другие поля последнего сообщения
                ];
            }),
            'users' => UserResource::collection($this->users->filter(function ($user) {
                return $user->id !== auth()->id();
            }),)
        //    'chat' => $this->whenLoaded('userChat.chat'),
//            'last_message' => $this->userChat->messages->last(),
//            'last_message' => Chat::class->lastMessage($this->id)
        ];
    }
}
