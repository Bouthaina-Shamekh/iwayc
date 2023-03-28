<?php

namespace App\Models;


use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Count_claim extends Model
{
  /*   use DateTimeInterface;
    /**
 * Prepare a date for array / JSON serialization.
 *
 * @param  \DateTimeInterface  $date
 * @return string
 */
    protected $table = 'count_claim';
    protected $fillable = ['collection_fees_id','student_course_id','how_claim','notes','isdelete','created_by','updated_by','deleted_by'];

 /*    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d h:i:s');
    } */
}
