<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Money_year extends Model
{
    //
    protected $table = 'money_years';
    protected $fillable = ['year','start_year','end_year','money_goal','first_time_balance','active','basic_work','isdelete','created_by','updated_by','deleted_by'];

}
