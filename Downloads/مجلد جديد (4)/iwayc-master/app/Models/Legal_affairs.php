<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legal_affairs extends Model
{
    //
    protected $table = 'legal_affairs';
    protected $fillable = ['m_year','student_course_id','phone','fees','fees_owed','count_day','fine_day','fine_delay','total_amount','warranty','count','count_warning','status','notes','isdelete','created_by','updated_by','deleted_by'];
}
