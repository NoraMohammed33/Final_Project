<?php

namespace App\Http\Controllers\API;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function getMessages(Request $request){
        $user1 = Auth::id();
        $user2 = $request->input('recipient_id');

        $messages = Message::where(function ($query) use ($user1, $user2) {
            $query->where('sender_id', $user1)->where('recipient_id', $user2);
        })->orWhere(function ($query) use ($user1, $user2) {
            $query->where('sender_id', $user2)->where('recipient_id', $user1);
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->sender_id = auth()->user()->id;
        $message->recipient_id = $request->input('recipient_id');
        $message->content = $request->input('content');
        $message->save();

        event(new MessageSent($message));

        return response()->json(['message' => 'Message sent']);
    }
}
