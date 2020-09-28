<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded      = [];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    public function comments() {

        return $this->hasMany(Comment::class);

    }


    public function childrenComments() {
        return $this->hasMany(Comment::class)->with('comments');
    }
}
