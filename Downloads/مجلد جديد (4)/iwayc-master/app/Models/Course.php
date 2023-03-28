<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['courseAR','courseEN','category_id','m_year','course_time','begin','reg_fees','decisions_fees','course_fees','total_fees','teacher_id','teacher_fees','ratio_type','percentage','value_sum','total_reg_student','total_withdrawn_student','active','ratio','notes','isdelete','created_by','updated_by','deleted_by'];
}
