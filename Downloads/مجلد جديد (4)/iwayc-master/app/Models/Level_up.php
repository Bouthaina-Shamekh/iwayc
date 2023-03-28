<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level_up extends Model
{
    //
    protected $table = 'level_ups';
    protected $fillable = ['date','student_id','level','total','level_up','notes','isdelete','created_by','updated_by','deleted_by'];
}
