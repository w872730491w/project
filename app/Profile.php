<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'cover',
        'sex',
        'introduction',
        'place',
        'describe',
        'career',
        'education',
        'describe'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
