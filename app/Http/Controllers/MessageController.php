<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respositories\MessageRespository;

class MessageController extends Controller
{
    protected $message;

    public function __construct(MessageRespository $message)
    {
        $this->message = $message;
    }

    public function sendMessage(Request $request)
    {
        $this->message->sendMessage($request);
    }
}
