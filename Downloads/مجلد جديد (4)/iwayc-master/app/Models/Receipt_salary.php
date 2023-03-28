<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt_salary extends Model
{
    //
    protected $table = 'receipt_salaries';
    protected $fillable = ['id','id_comp','employee_id','m_year','date','nets','month','salary','receipts','rewards','advance_payment','remainder','amount','notes','box_id','isdelete','created_by','updated_by','deleted_by'];
}
