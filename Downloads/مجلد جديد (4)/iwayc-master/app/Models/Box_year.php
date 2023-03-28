<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Box_year extends Model
{
    //
    protected $table = 'box_year';
    protected $fillable = ['m_year','box_id','calculator_first','income','expense','islock','created_by','updated_by','deleted_by'];
}
