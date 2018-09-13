<?php

namespace App\Respositories;

use Illuminate\Http\Request;
use Auth;
use App\Inbox;
use App\Message;

class InboxRespository
{
    public function getAuthInbox()
    {
        $messages = Message::select('inbox_id')->where('from_user_id', Auth::id())->orWhere('to_user_id', Auth::id())->distinct()->get();
        $inboexes = Inbox::whereIn('id', $messages)->get()->each(function ($inbox) {
        	$inbox->message = $inbox->message()->orderBy('created_at', 'desc')->first();
        });
        return $inboexes;
    }

    public function show($id)
    {
    	$inbox = Inbox::with([
    		'message'=> function ($query) {
    			return $query->orderBy('created_at', 'desc');
    		}
    	])->find($id);
    	return compact('inbox');
    }
}
