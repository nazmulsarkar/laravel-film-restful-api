<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function film()
    {
        $this->belongsTo('\Models\Film','film_id','id');
    }
}
