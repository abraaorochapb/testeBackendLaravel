<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['title', 'link', 'description', 'tags'];
    
    protected $casts = [
        'tags' => 'array',
    ];
}
