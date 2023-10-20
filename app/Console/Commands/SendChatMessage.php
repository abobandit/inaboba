<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class SendChatMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:message {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send chat message';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = Auth::user();
        $message = Message::create([

        ]);
    }
}
