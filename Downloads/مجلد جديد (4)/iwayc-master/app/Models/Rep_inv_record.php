<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rep_inv_record extends Model
{
    //
    protected $table = 'rep_inv_record';
    protected $fillable = ['repository_id','user_id','date_inv','sum_remaind','date_done','admin_id'];
}
