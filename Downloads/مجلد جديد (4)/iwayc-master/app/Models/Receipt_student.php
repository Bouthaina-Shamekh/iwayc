<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Receipt_student extends Model
{
    //
    protected $table = 'receipt_students';
    protected $fillable = ['id','id_comp','student_course_id','m_year','date','amount','box_id','notes','isdelete','created_by','updated_by','deleted_by'];
}
