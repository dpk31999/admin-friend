<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessageOfBoth($user1,$user2)
    {
        $messages = Message::where(function ($query) use ($user1,$user2){
            $query->where('from',$user2)->where('to',$user1);
        })->orWhere(function($query) use($user1,$user2){
            $query->where('from',$user1)->where('to',$user2);
        })->get();

        return response()->json($messages, 200);
    }
}
