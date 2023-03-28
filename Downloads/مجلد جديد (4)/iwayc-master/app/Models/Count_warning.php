<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Count_warning extends Model
{
    //
    protected $table = 'count_warning';
    protected $fillable = ['legal_affairs_id','student_course_id','how_claim','notes','isdelete','created_by','updated_by','deleted_by'];
}
