<?php

namespace App;

use App\Message;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Conversation extends Model
{
    use Cachable;
    protected $table = 'conversations';
    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(Message::class, 'conv_id', 'id');
    }

    public function first_user()
    {
        return $this->belongsTo('App\User', 'user_1');
    }

    public function seecond_user()
    {
        return $this->belongsTo('App\User', 'user_2');
    }
}
