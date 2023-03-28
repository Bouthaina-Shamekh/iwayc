<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive_edit extends Model
{
    //
    protected $table = 'archive_edit';
    protected $fillable = ['archive_id','user_id'];
}
