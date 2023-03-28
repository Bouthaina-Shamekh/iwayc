<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    //
    protected $table = 'withdrawals';
    protected $fillable = ['student_course_id','m_year','phone','price','payment','fines','refund','teacher_fees','center_fees','reason','isdelete','created_by','updated_by','deleted_by'];
}
