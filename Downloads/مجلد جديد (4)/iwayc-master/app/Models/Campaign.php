<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    //
    protected $table = 'campaigns';
    protected $fillable = ['id','title','start','active','isdelete','notes','created_by','updated_by','deleted_by'];
}
