<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_year extends Model
{
    //
    protected $table = 'user_year';
    protected $fillable = ['user_id','year'];
}
