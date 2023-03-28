<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive_view extends Model
{
    //
    protected $table = 'archive_view';
    protected $fillable = ['archive_id','user_id'];
}
