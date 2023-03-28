<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    //
    protected $table = 'links';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
