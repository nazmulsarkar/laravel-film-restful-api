<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Film;
// use App\User;

class Comment extends Model
{
    public function film()
    {
        return $this->belongsTo('App\Film');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
