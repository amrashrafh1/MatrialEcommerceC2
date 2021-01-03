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
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model implements Searchable
{
   // use Likeable;
   // use LogsActivity;
   use HasTranslations, Cachable, \Spatie\Tags\HasTags,LogsActivity;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'image',
        'publish_at',
        'user_id',
        'commentable',
        'slug',
        'meta_tag',
        'meta_description', 'meta_keyword'
    ];
    public $translatable = ['title','content'];

    protected static $logName = 'posts';

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName) :string
    {
        return "posts-{$eventName}";
    }

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
