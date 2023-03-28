<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence_s extends Model
{
    //
    protected $table = 'absences_s';
    protected $fillable = ['m_year','date','student_course_id','type','delay_time','notes','isdelete','created_by','updated_by','deleted_by'];
}
