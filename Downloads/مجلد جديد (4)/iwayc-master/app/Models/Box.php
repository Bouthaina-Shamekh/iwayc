<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    //
    protected $table = 'boxes';
    protected $fillable = ['name','m_year','type','parent_id','active','isdelete','created_by','updated_by','deleted_by'];
}
