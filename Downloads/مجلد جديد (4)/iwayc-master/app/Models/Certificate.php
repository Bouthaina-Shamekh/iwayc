<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    //
    protected $table = 'certificates';
    protected $fillable = ['uid','type','year','student_id','student_name','nationality','place_birth','year_birth','course_id','total_hours','start_day','end_day','appreciation','certificate_fees','catch_receipt_id','print_execute','release_date','description','isdelete','created_by','updated_by','deleted_by'];
}
