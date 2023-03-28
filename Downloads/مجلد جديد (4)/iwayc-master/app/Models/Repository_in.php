<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository_in extends Model
{
    //
    protected $table = 'repository_ins';
    protected $fillable = ['repository_id','m_year','id_comp','customer','section','material_id','count','single_pay','quantity','total','notes','print','isdelete','created_by','updated_by','deleted_by'];
}
