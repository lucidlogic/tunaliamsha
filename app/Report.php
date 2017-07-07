<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'spelling' => 'array',
        'pricing' =>  'array',
        'tone' =>  'array',
        'image' =>  'array',
    ];
}
