<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respositories\AnswerRespository;

class AnswerController extends Controller
{
	protected $answer;

	public function __construct(AnswerRespository $answer)
	{
		$this->answer = $answer;
	}

	public function store(Request $request)
	{
		$answer = $this->answer->store($request);
		return redirect('/question/'.$answer->question_id.'/answer/'.$answer->id)->with(['message'=> '回答成功！', 'color'=> 'green']);
	}

    public function getUserAnswers($id)
    {
    	$question = $this->answer->getUserAnswers($id);
    	return response()->json($question);
    }

    public function getAnswers(Request $request, $id)
    {
    	$answers = $this->answer->getAnswers($request, $id);
    	return response()->json($answers);
    }
}
