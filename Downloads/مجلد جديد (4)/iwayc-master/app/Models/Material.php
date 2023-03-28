<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $table = 'materials';
    protected $fillable = ['name','repository_id','section','count_old','count_new','single_cost','single_pay','active','notes','isdelete','created_by','updated_by','deleted_by'];
}
