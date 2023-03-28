<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    protected $table = 'quantities';
    protected $fillable = ['material_id','m_year','repository_id','section','count_old','count_new','single_cost','single_pay','count','notes','isdelete','created_by','updated_by','deleted_by'];
}
