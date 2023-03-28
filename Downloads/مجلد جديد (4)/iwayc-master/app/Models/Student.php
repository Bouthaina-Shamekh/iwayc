<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    protected $fillable = ['m_year','nameAR','nameEN','birthday','gender','place_birth','nationality','address','email','how_listen','phone1','phone2','whatsup','level','work','classification','active','notes','isdelete','created_by','updated_by','deleted_by'];
}
