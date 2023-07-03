<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function getAllContacts(){
        $user = Auth::user();
        $contacts = User::where('id','!=',auth()->id())->get();
        $response = [
            'user' => $user,
            'contacts' => $contacts,
        ];
        return response()->json($response);
    }
    public function getMessagesFor($id){
        $messages = Message::where('sender_id',$id)->orWhere('recipient_id',$id)->get();
        return response()->json($messages);
    }
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $request->input('contact_id'),
            'content' => $request->input('content')
        ]);

        broadcast(new MessageSent($message));
        return response()->json($message);
    }
}
