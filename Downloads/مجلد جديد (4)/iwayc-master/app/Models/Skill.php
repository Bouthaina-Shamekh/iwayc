<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    protected $table = 'skills';
    protected $fillable = ['name','employee_id','isdelete','created_by','updated_by','deleted_by'];
}
