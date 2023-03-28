<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income_levels extends Model
{
    //
    protected $table = 'income_levels';
    protected $fillable = ['name','m_year','in_from','in_to','remaind','expenses','balance','level1','level2','level3','level4','level5','active','isdelete','created_by','updated_by','deleted_by'];
}
