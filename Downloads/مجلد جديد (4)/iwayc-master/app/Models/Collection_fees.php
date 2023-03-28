<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection_fees extends Model
{
    //
    protected $table = 'collection_fees';
    protected $fillable = ['m_year','student_course_id','phone','fees','fees_pay','fees_owed','warranty','count','evasion','notes','isdelete','created_by','updated_by','deleted_by'];
}
