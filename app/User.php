<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function owns($question)
    {
        return $this->id === $question->user_id;
    }

    public function is_self()
    {
        return Auth::check() && Auth::id() === $this->id;
    }

    public function follow()
    {
        return $this->belongsToMany(User::class, 'user_users', 'follow_user_id', 'followed_user_id');
    }

    public function followed()
    {
        return $this->belongsToMany(User::class, 'user_users', 'followed_user_id', 'follow_user_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function checkFollowed($user_id)
    {
        return $this->follow()->where('followed_user_id', $user_id)->count();
    }

    public function userQuestion() {
        return $this->belongsToMany(Question::class, 'user_questions', 'user_id', 'follow_question_id');
    }

    public function userTopic()
    {
        return $this->belongsToMany(Topic::class, 'user_topics', 'user_id', 'follow_topic_id');
    }

    public function voteAnswer()
    {
        return $this->belongsToMany(Answer::class, 'vote_answers', 'user_id', 'vote_answer_id');
    }

    public function voteComment()
    {
        return $this->belongsToMany(Comment::class, 'vote_comments', 'user_id', 'vote_comment_id');
    }

    // 一个用户接受多个私信
    public function receiveMessage()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }

    // 一个用户能发送多个私信
    public function sendMessage()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }
}
