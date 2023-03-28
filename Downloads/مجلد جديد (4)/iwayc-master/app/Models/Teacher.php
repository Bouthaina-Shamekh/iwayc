<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $table = 'teachers';
    protected $fillable = ['m_year','name','specialization','birthday','nationality','address','phone1','phone2','email','classification','active','notes','isdelete','created_by','updated_by','deleted_by'];
}
