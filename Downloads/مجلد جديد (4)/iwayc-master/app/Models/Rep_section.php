<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rep_section extends Model
{
    //
    protected $table = 'rep_sections';
    protected $fillable = ['name','repository_id','isdelete','created_by','updated_by','deleted_by'];
}
