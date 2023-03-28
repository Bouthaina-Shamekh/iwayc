<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class English_reg extends Model
{
    //
    protected $table = 'english_reg';
    protected $fillable = ['level_id','student_id','status','iswithdrawal','ispass','isdelete','created_by','updated_by','deleted_by'];
}
