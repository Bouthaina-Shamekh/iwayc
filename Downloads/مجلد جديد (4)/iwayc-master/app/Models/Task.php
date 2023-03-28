<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table = 'tasks';

    protected $fillable = ['sender','receiver','title','category','details','start_date','end_date','active','reminders_num','evaluate','notes','isdelete','created_by','updated_by','deleted_by'];

}
