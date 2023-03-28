<?php

namespace Database\Seeders;

use App\Models\Skills;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$states = ['اجتماعي' ,' استخدام الحاسوب والانترنت ', 'الادارة', 'الانجليزية جيدة' ,' الانجليزية ممتازة ',' التحصيل المالي', 'التسويق الالكتروني ',' التسويق الهاتفي',' المحاسبة' ,' تحمل ضغط العمل' ,' تدريس تأسيس انجليزي' ,' تدريس تأسيس رياضيات' ,' قيادة السيارة ',' لغات اخرى',' مظهر جذاب ',' مظهر متواضع ',' مظهر متوسط '];

      for ($item=0; $item < count($states); $item++) {
           foreach ($states as $state) {
            $state = new Skills;
            $state->name = $states[$item];
            $state->save();
            $item+=1;
      }


   }
     }
}
