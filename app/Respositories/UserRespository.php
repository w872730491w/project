<?php

namespace App\Respositories;

use App\Notifications\UserFollowNotification;
use App\Notifications\LikesNotification;
use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Topic;
use Auth;

class UserRespository
{
    public function getUser($user_id)
    {
    	$user = User::with('profile')->find($user_id);
    	$user->is_self = $user->is_self();
        return $user;
    }

    public function getFollow($type, $id)
    {
    	return User::find($id)->$type;
    }

    public function update($data)
    {
        
    	return Auth::user()->profile->update($data);
    }

    public function getUserCardInfo(Request $request)
    {
        $user = User::find($request->get('id'));
        $user->is_self = $user->is_self();
        $user->is_follow = Auth::check() && Auth::user()->checkFollowed($user->id);
        return $user;
    }

    public function follow(Request $request, $type)
    {
        $method = $type == 'user' ? 'follow' : 'user'.ucfirst($type) ;
        $id = $request->get('id');
        $data = Auth::user()->$method()->toggle($id);
        $type = 'App\\'.ucfirst($type);
        $class = new $type();
        $class = $class->find($id);
        if($data['attached']){
            if($type == 'App\User'){
                Auth::user()->increment('followers_count');
                User::find($id)->increment('followings_count');
                User::find($id)->notify(new UserFollowNotification([
                    'user_name' => Auth::user()->name,
                    'user_id' => Auth::id(),
                    'user_avatar' => Auth::user()->avatar,
                    'user_introduction' => Auth::user()->profile->introduction
                ]));
            } else {
                $class->increment('followers_count');
            }
        } else {
            if($type == 'App\User'){
                Auth::user()->decrement('followers_count');
                User::find($id)->decrement('followings_count');
            } else {
                $class->decrement('followers_count');
            }
        }
        return $data;
    }

    public function vote(Request $request, $vote_type)
    {
        $id = $request->get('id');
        $method = 'vote'.ucfirst($vote_type);
        $data = Auth::user()->$method()->toggle($id);
        $className = 'App\\'.ucfirst($vote_type);
        $class = new $className;
        $class = $class->find($id);
        if($data['attached']){
            $class->increment('votes_count');
            if($vote_type == 'comment'){
                $question = is_null($class->commentable->title) ? $class->commentable->question : $class->commentable ;
                $to_url = '/question/'.$question->id;
                $like = '评论';
            } else {
                $question = $class->question;
                $to_url = '/question/'.$question->id.'/answer/'.$class->id;
                $like = '回答';
            }
            $class->user->notify(new LikesNotification([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'like' => '赞同了你的'.$like,
                'to_name' => $question->title,
                'to_url' => $to_url
            ]));
        } else {
            $class->decrement('votes_count');
        }
        return $data;
    }
}
