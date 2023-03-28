<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Receipt_course extends Model
{
    //
    protected $table = 'receipt_courses';
    protected $fillable = ['id','id_comp','type','m_year','date','course_id','teacher_ratio','teacher_pay','remainder','amount','cheque_info','notes','box_id','isdelete','created_by','updated_by','deleted_by'];
}
