<?php

namespace App\Zabor\Mysql;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $casts = [
        'published'     => 'boolean'
    ];
    
    protected $guarded = [];
}
