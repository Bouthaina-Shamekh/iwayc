<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt_advance extends Model
{
    //
    protected $table = 'receipt_advances';
    protected $fillable = ['id','id_comp','employee_id','m_year','date','advance_payment','month_count','month_payment','start_payment','notes','box_id','isdelete','created_by','updated_by','deleted_by'];
}
