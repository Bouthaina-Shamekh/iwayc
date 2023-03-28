<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catch_receipt_box extends Model
{
    //
    protected $table = 'catch_receipt_boxes';
    protected $fillable = ['id','id_comp','box_id','m_year','date','type','customer','count','amount','notes','isdelete','created_by','updated_by','deleted_by'];
}
