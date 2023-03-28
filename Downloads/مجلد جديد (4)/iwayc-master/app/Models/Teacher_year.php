<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher_year extends Model
{
    //
    protected $table = 'teachers_year';
    protected $fillable = ['m_year','teacher_id','active','created_by','updated_by','deleted_by'];
}
