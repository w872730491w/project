<?php

namespace App\Respositories;

use App\Notifications\AnswerNotification;
use App\Notifications\FollowNotification;
use Illuminate\Http\Request;
use App\User;
use App\Answer;
use App\Question;
use Auth;

class AnswerRespository
{
    public function getUserAnswers($user_id)
    {
    	$questions = collect([]);
    	Answer::with('user')->where('user_id', $user_id)->get()->each(function ($answer) use (&$questions) {
    		$question = Question::find($answer->question_id);
    		$question->answer = $answer->toArray();
            $question->answer['is_vote'] = Auth::check() && Auth::user()->voteAnswer()->where('vote_answer_id', $question->answer->id)->count();
    		$questions[] = $question;
    	});
    	return $questions;
    }

    public function store(Request $request)
    {
        $answer = Answer::create([
            'user_id' => Auth::id(),
            'question_id' => $request->get('question_id'),
            'body' => $request->get('body')
        ]);
        $answer->question->user->notify(new AnswerNotification([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'question_id' => $answer->question->id,
            'question' => $answer->question->title
        ]));
        Auth::user()->followed->each(function ($user) use ($answer) {
            $user->notify(new FollowNotification([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'to_url' => '/question/'.$answer->question->id.'/answer/'.$answer->id
            ]));
        });
        $answer->question->increment('answers_count');
        return $answer;
    }

    public function getAnswers(Request $request, $id)
    {
        $orderBy = $request->get('order') == 'vote' ? 'votes_count' : 'created_at' ;
        return Answer::with([
            'user' => function ($query) {
                return $query->with('profile');
            }
        ])->where('question_id', $id)->orderBy($orderBy, 'desc')->get()->each(function ($answer) {
            $answer->is_self = $answer->user->is_self();
            $answer->is_vote = Auth::check() && Auth::user()->voteAnswer()->where('vote_answer_id', $answer->id)->count();
        });
    }
}
