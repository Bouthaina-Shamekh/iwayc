<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class English_sal extends Model
{
    //
    protected $table = 'english_sal';
    protected $fillable = ['student_id','birthday','region','classification','phone','level_up','type','resolution','notes','isdelete','created_by','updated_by','deleted_by'];
}
