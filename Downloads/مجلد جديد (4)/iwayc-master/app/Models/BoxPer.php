<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxPer extends Model
{
    //
    protected $table = 'box_per';
    protected $fillable = ['id','box_id','user_id'];
}
