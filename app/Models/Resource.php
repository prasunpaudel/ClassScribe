<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'week_id',
        'link',
    ];
    protected $table = 'resources';
}
