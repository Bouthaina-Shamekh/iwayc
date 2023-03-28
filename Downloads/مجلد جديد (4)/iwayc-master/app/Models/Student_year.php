<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_year extends Model
{
    //
    protected $table = 'students_year';
    protected $fillable = ['m_year','student_id','active','created_by','updated_by','deleted_by'];
}
