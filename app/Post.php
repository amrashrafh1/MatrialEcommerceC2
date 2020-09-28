<?php

namespace App;
//use Cog\Likeable\Contracts\Likeable as LikeableContract;
//use Cog\Likeable\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;
//use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Translatable\HasTranslations;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Post extends Model implements Searchable
{
   // use Likeable;
   // use LogsActivity;
   use HasTranslations, Cachable, \Spatie\Tags\HasTags;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'image',
        'publish_at',
        'user_id',
        'commentable',
        'slug'

    ];
    public $translatable = ['title','content'];



    public function getSearchResult(): SearchResult
    {
        $url = route('posts.edit', $this->id);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
        );
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
