<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        $message = ChatMessage::create([
            'user_id' => auth()->id(),
            'ticket_id' => $request->ticket_id,
            'message' => $request->message,
        ]);

        broadcast(new ChatMessageSent($message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
