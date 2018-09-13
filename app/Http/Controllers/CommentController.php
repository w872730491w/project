<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respositories\CommentRespository;

class CommentController extends Controller
{
	protected $comment;

	public function __construct(CommentRespository $comment)
	{
		$this->comment = $comment;	
	}

	public function store(Request $request)
	{
		$this->comment->store($request);
	}

    public function getComments(Request $request, $type, $type_id)
    {
    	$comments = $this->comment->getComments($request, $type, $type_id);
        return response()->json( $comments );
    }
}
