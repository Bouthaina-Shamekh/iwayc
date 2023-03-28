<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class English extends Model
{
    use HasFactory;
    protected $table = 'englishes';
    protected $fillable = ['date','student_name','year','address','phone1','phone2','cash_rec_id','writing','reading','grammer','conversation','total','level_pass','classification','active','skills','notes','isdelete','created_by','updated_by','deleted_by'];
}
