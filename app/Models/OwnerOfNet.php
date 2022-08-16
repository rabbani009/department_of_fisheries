<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerOfNet extends Model
{
    use HasFactory;

    public function getOwnerOfNet()
    {
        return static::orderBy('id','ASC')->get();
    }
}
