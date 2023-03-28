<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign_student extends Model
{
    //
    protected $table = 'campaign_student';
    protected $fillable = ['campaign_id','name','birthday','address','course_reg','type','notes','phone','response','resolution','isdelete','created_by','updated_by','deleted_by'];
}
