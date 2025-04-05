<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    public function weeks()
    {
        return $this->hasMany(Week::class);
    }
}
