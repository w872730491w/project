<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respositories\NotificationRespository;

class NotificationController extends Controller
{
	protected $notification;

	public function __construct(NotificationRespository $notification)
	{
		$this->notification = $notification;
	}

    public function getNotification($user_id)
    {
    	$notifications = $this->notification->getNotification($user_id);
    	return response()->json( $notifications );
    }

    public function readMessage()
    {
    	$this->notification->readMessage();
    }
}
