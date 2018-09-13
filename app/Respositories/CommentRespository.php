<?php

namespace App\Respositories;

use Illuminate\Http\Request;
use App\Notifications\CommentNotification;
use App\Comment;
use Auth;

class CommentRespository
{
    public function store(Request $request)
    {
        $type = 'App\\'.ucfirst($request->get('type'));
        $model = new $type;
        $model = $model->find($request->get('type_id'));
        $data = [
            'body'=> $request->get('body'),
            'user_id'=> Auth::id(),
            'commentable_id'=> $request->get('type_id'),
            'commentable_type'=> $type
        ];

        // 发送通知
        $commentType = $type=='App\\Answer' ? '回答' : '问题' ;
        $title = is_null($model->title) ? $model->question->title : $model->title ;
        $url = is_null($model->question_id) ? '/question/'.$model->id : '/question/'.$model->question_id.'/answer/'.$model->id ;
        $model->user->notify(new CommentNotification([
            'user_id'=> Auth::id(),
            'type'=> $commentType,
            'user_name' => Auth::user()->name,
            'title' => $title,
            'url' => $url
        ]));

        if($request->get('to_comment_id')){
            $data['to_comment_id'] = $request->get('to_comment_id');
        }
        $comment = Comment::create($data);
        $model->find($request->get('type_id'))->increment('comments_count');
        $comment->user = $comment->user;
        $comment->votes_count = 0;
        return $comment;
    }

    public function getComments(Request $request, $type, $type_id)
    {
        $type =  'App\\'.ucfirst($type);
        $class = new $type;
        $data = $class->find($type_id)->comments()->with('user')->orderBy($request->get('orderBy'), 'desc')->skip($request->get('skip'))->take(5)->get()->each(function ($comment)
        {
            if($comment->to_comment_id) {
                $comment->replyUser = Comment::find($comment->to_comment_id)->user;
            }
            $comment->showReply = false;
            $comment->is_vote = Auth::check() && Auth::user()->voteComment()->where('vote_comment_id', $comment->id)->count();
            $comment->is_self = Auth::check() && Auth::id()==$comment->user_id;
        });
        return $data;
    }
}
