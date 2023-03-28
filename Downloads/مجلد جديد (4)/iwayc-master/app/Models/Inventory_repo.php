<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory_repo extends Model
{

    protected $table = 'inventoryrepos';
    protected $fillable = ['repository_id','inventory_num','resUser_id','is_accept','rem_price','created_by','isdelete'];
}
