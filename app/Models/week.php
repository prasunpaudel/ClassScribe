<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class week extends Model
{
    protected $fillable = [
        'topic_covered', 
        'resources', 
        'important_points', 
        'practical_implementation', 
        'week_summary', 
        'next_topic', 
        'next_session_prep', 
        'class_name_id',
    ];

    // Week belongs to a class
    public function className()
    {
        return $this->belongsTo(ClassName::class);
    }
}
