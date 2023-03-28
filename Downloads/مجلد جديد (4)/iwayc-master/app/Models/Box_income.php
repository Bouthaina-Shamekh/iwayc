<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box_income extends Model
{
    //
    protected $table = 'box_income';
    protected $fillable = ['name','box_id','created_by','updated_by','deleted_by'];
}
