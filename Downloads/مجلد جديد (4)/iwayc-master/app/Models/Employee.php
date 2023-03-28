<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = 'employees';
    protected $fillable = ['name','job_title','birthday','nationality','status','address','phone1','phone2','email','salary_down','smoke','active','skills','notes','user_id','isdelete','created_by','updated_by','deleted_by','level'];
}
