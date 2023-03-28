<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catch_receipt extends Model
{
    //
    protected $table = 'catch_receipts';
    protected $fillable = ['id','id_comp','box_id','date','m_year','student_course_id','remainder','amount','cheque_info','notes','isdelete','created_by','updated_by','deleted_by'];
}
