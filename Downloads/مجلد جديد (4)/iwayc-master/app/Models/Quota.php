<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Quota extends Model
{
    //
    protected $table = 'quota';
    protected $fillable = ['m_year','course_id','day','room','type','time','time_to','isdelete','created_by','updated_by','deleted_by'];
}
