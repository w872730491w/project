<?php

namespace App\Respositories;

use Illuminate\Http\Request;
use App\User;
use Auth;

class NotificationRespository
{
    public function getNotification($user_id)
    {
    	return User::find($user_id)->notifications->where('type', '!=', 'App\Notifications\MessageNotification');
    }

    public function readMessage()
    {
    	Auth::user()->notifications->markAsRead();
    }
}
