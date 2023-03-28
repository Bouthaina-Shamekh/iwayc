<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record_done extends Model
{
    //
    protected $table = 'record_done';
    protected $fillable = ['title','type','row_id','slug','res','isdelete','created_by','updated_by','deleted_by'];
}
