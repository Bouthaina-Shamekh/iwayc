<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt_warranty extends Model
{
    //
    protected $table = 'receipt_warranties';
    protected $fillable = ['id','id_comp','m_year','date','salary_id','amount','notes','box_id','isdelete','created_by','updated_by','deleted_by'];
}
