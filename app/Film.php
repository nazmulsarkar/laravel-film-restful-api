<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
// use App\Comment;
// use App\User;

class Film extends Model
{
    use Sluggable;

    // define the fillable fields
    protected $fillable = ['user_id', 'title', 'description', 'release_on', 'rating', 'price', 'country', 'genre', 'photo'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
