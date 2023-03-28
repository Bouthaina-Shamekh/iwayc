<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt_reward extends Model
{
    //
    protected $table = 'receipt_rewards';
    protected $fillable = ['id','id_comp','employee_id','m_year','date','type','amount','receipts_rewards','reason','notes','box_id','isdelete','created_by','updated_by','deleted_by'];
}
