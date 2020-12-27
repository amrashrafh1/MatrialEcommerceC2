<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Files;
use App\Product;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Message extends Model
{
    use Cachable;
    protected $table   = 'messages';
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class, 'm_from');
    }
    public function product()
    {
    	return $this->belongsTo(Product::class, 'product_id');
    }

    /* public function files()
    {
        return $this->morphMany(Files::class, 'files');
    } */
    public function gallery()
    {
        return $this->morphMany(Files::class, 'relation');
    }
}
