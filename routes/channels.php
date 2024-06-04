<?php

use App\Broadcasting\ChatChannel;
use App\Models\User;
use App\Models\UserChat;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{userid}',function(User $user,$userid){
    return Auth::check();
});
