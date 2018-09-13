<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $fillable = [

    ];

    public function message()
    {
    	return $this->hasMany(Message::class);
    }
}
