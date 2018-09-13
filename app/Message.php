<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'content', 'from_user_id', 'to_user_id', 'has_reading', 'read_at', 'inbox_id'
    ];

    // 一个私信属于只能发给一个用户
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    // 一个私信只能由一个用户发送
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }
}
