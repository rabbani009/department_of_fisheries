<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearlyLoan extends Model
{
    use HasFactory;

    public function getYearlyLoan(){
        return static::orderBy('id','ASC')->get();
    }
}
