<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    // define the fillable fields
    protected $fillable = ['user_id', 'title', 'description', 'release_on', 'rating', 'price', 'country', 'genre', 'photo'];
}
