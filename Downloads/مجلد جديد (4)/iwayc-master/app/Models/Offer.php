<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $table = 'offers';
    protected $fillable = ['date','title','type','details','img','fees_reg','fees_bag','fees_course','amount','discount_r','discount_v','total','desc_refund','active','notes','isdelete','created_by','updated_by','deleted_by'];
}
