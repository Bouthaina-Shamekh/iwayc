<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository_year extends Model
{
    //
    protected $table = 'repositories_year';
    protected $fillable = ['m_year','repository_id','repository_in','repository_out','active','created_by','updated_by','deleted_by'];
}
