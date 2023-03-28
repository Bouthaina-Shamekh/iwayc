<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_course extends Model
{
    //
    protected $table = 'student_course';
    protected $fillable = ['course_id','m_year','student_id','price','payment','iswithdrawal','isdelete','created_by','updated_by','deleted_by'];

}
