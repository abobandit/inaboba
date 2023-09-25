<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array[]
     */
    public function toArray(Request $request)
    {
        return [
                'id' => $this->id,
                'login' => $this->login,
                'email' => $this ->email,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'profile_pic' => $this-> profile_pic,
        ];
    }
}
