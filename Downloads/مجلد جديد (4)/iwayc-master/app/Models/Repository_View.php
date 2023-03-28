<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository_View extends Model
{
    //
    protected $table = 'repository_view';
    protected $fillable = ['repository_id','user_id'];
}
