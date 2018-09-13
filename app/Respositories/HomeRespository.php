<?php

namespace App\Respositories;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Question;
use App\Topic;
use App\Answer;

class HomeRespository
{
    public function search(Request $request)
    {
        $q = $request->get('q');
        $users = User::where('name', 'like', '%'.$q.'%')->get();
        $topics = Topic::where('name', 'like', '%'.$q.'%')->get();
        $questions = Question::where('title', 'like', '%'.$q.'%')->get()->each(function ($question) {
            $question->answer = Answer::with('user')->where('question_id', $question->id)->orderBy('votes_count')->first();
            $question->answer->is_self = $question->answer->user->is_self();
            $question->answer->is_vote = Auth::check() && Auth::user()->voteAnswer()->where('vote_answer_id', $question->answer->id)->count();
        });
        return compact('users', 'topics', 'questions');
    }
}
