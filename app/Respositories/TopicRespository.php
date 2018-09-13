<?php

namespace App\Respositories;

use Illuminate\Http\Request;
use App\Topic;
use Auth;

class TopicRespository
{
    public function getTopics(Request $request)
    {
        return Topic::select('id', 'name as text')->where('name', 'like', '%'.$request->get('q').'%')->get();
    }

    public function index()
    {
        $data['topics'] = Topic::orderBy('followers_count', 'desc')->get()->each(function ($topic) {
            $topic->is_follow = Auth::check() && Auth::user()->userTopic()->where('follow_topic_id', $topic->id)->count();
        });
        $data['hotTopics'] = Topic::orderBy('followers_count', 'desc')->take(3)->get();
        return $data;
    }

    public function show($id)
    {
        return Topic::find($id);
    }

    public function update(Request $request, $id)
    {
        Topic::find($id)->update([
            'desc'=> $request->get('desc')
        ]);
    }

    public function getTopicDiscuuss($id)
    {
        return Topic::find($id)->question()->has('answer')->get()->each(function ($question) {
            $question->answer = $question->answer()->with([
                'user'=> function ($query) {
                    return $query->with('profile');
                }
            ])->first();
            $question->answer->is_self = $question->answer->user->is_self();
            $question->answer->is_vote = Auth::check() && Auth::user()->voteAnswer()->where('vote_answer_id', $question->answer->id)->count();
        });
    }

    public function getTopicEssence($id)
    {
        return Topic::find($id)->question()->has('answer')->get()->each(function ($question) {
            $question->answer = $question->answer()->orderBy('votes_count', 'desc')->with([
                'user'=> function ($query) {
                    return $query->with('profile');
                }
            ])->first();
            $question->answer->is_self = $question->answer->user->is_self();
            $question->answer->is_vote = Auth::check() && Auth::user()->voteAnswer()->where('vote_answer_id', $question->answer->id)->count();
        });
    }

    public function getTopicAnswer($id)
    {
        return Topic::find($id)->question()->doesntHave('answer')->get();
    }
}
