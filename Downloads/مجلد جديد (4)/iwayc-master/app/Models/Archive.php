<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archives';
    protected $fillable = ['section','sub_section','address','details','image','active','notes','isdelete','created_by','updated_by','deleted_by'];
}
