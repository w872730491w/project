<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desc', 'topic_pic'
    ];

    public function question() {
        return $this->belongsToMany(Question::class, 'question_topics')->withTimestamps();
    }
}
