<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query_admin extends Model
{
    protected $table = 'query_admin';
    protected $fillable = ['subject','count','day1','day7','day15','day30','day60','day90','day180','last1','last2','last3'];
}
