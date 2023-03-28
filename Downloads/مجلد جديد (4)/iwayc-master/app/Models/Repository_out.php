<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository_out extends Model
{
    //
    protected $table = 'repository_outs';
    protected $fillable = ['repository_id','m_year','id_comp','customer','statement','total','notes','print','isdelete','created_by','updated_by','deleted_by'];
}
