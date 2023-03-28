<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rep_inventory extends Model
{
    //
    protected $table = 'rep_inventory';
    protected $fillable = ['repository_id','section_id','material_id','pay_count','last_price','sum_pay','count','count_inv','remaind','rem_price','isdelete'];
}
