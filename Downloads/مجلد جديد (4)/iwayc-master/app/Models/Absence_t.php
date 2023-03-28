<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence_t extends Model
{
    //
    protected $table = 'absences_t';
    protected $fillable = ['m_year','date','course_id','type','delay_time','notes','isdelete','created_by','updated_by','deleted_by'];
}
