<?php

namespace App\Respositories;

use Illuminate\Http\Request;

use App\Question;
use App\Topic;
use App\Answer;
use Auth;

class QuestionRespository
{
    public function index()
    {
        return Question::where('answers_count', '<=', 10)->orderBy('answers_count', 'asc')->get();
    }

    public function show(Request $request, $id)
    {
        $question = Question::find($id);
        $writeAnswer = $request->get('writeAnswer') ? true : false;
        return compact('question', 'writeAnswer');
    }

    public function store(Request $request)
    {
        $topics = $this->crateTopics($request->get('topics'));

        $data = [
            'title'=> $request->get('title'),
            'body'=> $request->get('body'),
            'user_id'=> Auth::id()
        ];

        $question = Question::create($data);

        if( $question ) {

            Auth::user()->userQuestion()->toggle($question->id);
            $question->user()->increment('questions_count');
            $question->topic()->sync($topics);
            return $question;

        }
    }

    public function crateTopics(Array $topics)
    {
        return collect($topics)->map(function ($topic) {
            if( is_numeric($topic) &&  Topic::find((int) $topic)) {
                Topic::find((int) $topic)->increment('questions_count');
                return (int) $topic;
            }

            $newTopic = Topic::create([
                'name'=> $topic
            ]);
            $newTopic->increment('questions_count');

            return (int) $newTopic->id;
        })->toArray();
    }

    public function getQuestionList()
    {
        return Question::has('Answer')->with([
            'topic'
        ])->take(5)->get()->map(function ($question) {
            $question->answer = $question->answer()->with('user')->orderBy('votes_count', 'desc')->first();
            $question->answer->is_vote = Auth::check() && Auth::user()->voteAnswer()->where('vote_answer_id', $question->answer->id)->count();
            $question->answer->is_self = Auth::check() && Auth::id() == $question->answer->user_id;
            if(strlen($question->answer->body) > 200){ // 获取短内容
                $question->answer->collapsed_str = str_limit($question->answer->body, 200, '…');
                $video = strpos($question->answer->body, '<video>');
                $img = strpos($question->answer->body, '<img');
                $question->answer->hasVideo = $video ? true : false ;
                $question->answer->hasImg = $img ? true : false ;
                if ($video) {
                    $videoPattern = '/<video([^>]+)>(?:(?!<\/video>)[\s\S])*</video>/';
                    preg_match($videoPattern, $question->answer->body, $res);
                    $question->answer->cover = $res;
                }
                if ($img) {
                    $imgPattern = '/<img[\s\S]*?src\s*=\s*[\"|\'](.*?)[\"|\'][\s\S]*?>/';
                    preg_match($imgPattern, $question->answer->body, $res);
                    $question->answer->cover = $res;
                }
                if($video && $img) {
                    if($img < $video) {
                        $imgPattern = '/<img[\s\S]*?src\s*=\s*[\"|\'](.*?)[\"|\'][\s\S]*?>/';
                        preg_match($imgPattern, $question->answer->body, $res);
                    } else {
                        $videoPattern = '/<video([^>]+)>(?:(?!<\/video>)[\s\S])*</video>/';
                        preg_match($videoPattern, $question->answer->body, $res);
                    }
                    $question->answer->cover = $res;
                }
            }
            return $question;
        });
    }

    public function answer(Request $request, $question_id, $answer_id)
    {
        $question = Question::with([
            'topic',
            'answer'=> function ($query) use ($answer_id) {
                $query->with([
                    'user'=> function ($query) {
                        $query->with('profile');
                    }
                ])->find($answer_id);
            }
        ])->find($question_id);
        $question->answer[0]->is_vote = Auth::check() && Auth::user()->voteAnswer()->where('vote_answer_id', $question->answer[0]->id)->count();
        $answers = $question->answer()->where('id', '!=', $answer_id)->orderBy('votes_count', 'desc')->take(2)->get()->each(function ($answer) {
            $answer->is_vote = Auth::check() && Auth::user()->voteAnswer()->where('vote_answer_id', $answer->id)->count();
            $answer->is_self = Auth::check() && Auth::id() == $answer->user_id;
        });
        return compact(['question','answers']);
    }

    public function getUserQuestion($user_id)
    {
        return Question::where('user_id', $user_id)->get();
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        // 解除与话题的关系
        $question->topic()->detach();
        // 解除与用户的关系
        $question->user()->detach();
        // 删除问题下的回答
    }
}
