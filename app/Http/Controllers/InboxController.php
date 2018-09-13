<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respositories\InboxRespository;


class InboxController extends Controller
{
	protected $inbox;

	public function __construct(InboxRespository $inbox)
	{
		$this->inbox = $inbox;
	}

    public function index()
    {
    	$inboxes = $this->inbox->getAuthInbox();
    	return view('inbox.index', compact('inboxes') );
    }

    public function show($id)
    {
    	return view('inbox.show', $this->inbox->show($id) );
    }
}
