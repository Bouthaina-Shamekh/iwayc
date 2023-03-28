<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //
    protected $table = 'salaries';
    protected $fillable = ['employee_id','year','month','salary','salary_remaind','salary_warranty','warranty_secretariats','warranty_contributions','isdelete','created_by','updated_by','deleted_by'];
}
