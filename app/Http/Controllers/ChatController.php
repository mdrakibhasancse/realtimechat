<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
   
    

    public function chatForm($user_id){
        $user = User::select('name' , 'id')->where('id' , $user_id)->where('id', '<>', Auth::id())->first();
        $messages = Message::where(function($query) use ($user_id) {
            $query->where('sender_id', $user_id)->orWhere('receiver_id', $user_id);
        })->get();
        return view('chat' , compact('user', 'messages'));
    }

    public function sendMessage($user_id)
    {
        $message = request()->message;
        $user = User::select('name', 'id')->where('id', $user_id)->where('id', '<>', Auth::id())->first();
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user_id,
            'message' => $message,
        ]);
        broadcast(new MessageSent($user, $message));

        return response()->json([
           'status' => 'Message sent successfully!',
         ]);
    }
    
}
