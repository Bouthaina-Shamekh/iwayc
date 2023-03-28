<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign_filter extends Model
{
    //
    protected $table = 'campaign_filter';
    protected $fillable = ['campaign_id','type_id','filter_id','isdelete','created_by','updated_by','deleted_by'];
}
