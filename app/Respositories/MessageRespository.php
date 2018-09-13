<?php

namespace App\Respositories;

use App\Notifications\MessageNotification;
use Illuminate\Http\Request;
use App\Message;
use App\Inbox;
use App\User;
use Auth;

class MessageRespository
{
    public function sendMessage(Request $request)
    {
        $from_user_id = Auth::id();
        $to_user_id = $request->get('to_user_id');
        $content = $request->get('content');

        $data1 = Message::where('from_user_id', $from_user_id)->where('to_user_id', $to_user_id)->first();
        $data2 = Message::where('from_user_id', $to_user_id)->where('to_user_id', $from_user_id)->first();

        if((!$data1) && (!$data2)) {
            $inbox = Inbox::create([]);
            $inbox_id = $inbox->id;
        } else {
            $inbox_id = $data1->inbox_id ?? $data2->inbox_id;
        }

        Message::create( compact('from_user_id', 'to_user_id', 'content', 'inbox_id') );
        User::find($to_user_id)->notify(new MessageNotification([
            'from_user_name' => Auth::user()->name
        ]));
    }
}
