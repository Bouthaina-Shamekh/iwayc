<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    //
    protected $table = 'repositories';
    protected $fillable = ['name','box_id','isdelete','isDone','created_by','updated_by','deleted_by'];
}
