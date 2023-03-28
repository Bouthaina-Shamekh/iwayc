<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //
    protected $table = 'absences';
    protected $fillable = ['m_year','type','date','hour_out','center_car','region','leaving','hour_in','employee_id','hours','minutes','notes','isdelete','created_by','updated_by','deleted_by'];
}
