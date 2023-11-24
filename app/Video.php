<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $fillable = [
        'filename', 'thumnail_name', 'title','email','views',
    ];
}
