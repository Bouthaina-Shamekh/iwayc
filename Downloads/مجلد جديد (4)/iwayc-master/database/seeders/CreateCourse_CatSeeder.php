<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course_Cat;

class CreateCourse_CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $cats = [
          'مناهج ثانوي ',
          'مناهج اعدادي ',
          'مناهج ابتدائي ',
          'محو امية ',
          'محاسبة ',
          'محادثة انجليزي م 2 ',
          'محادثة انجليزي م 1 ',
          'محادثة انجليزي انترو م 2 ',
          'محادثة انجليزي انترو م 1',
          'صيانة خلويات ',
          'صيانة اجهزة مكتبية ',
          'صعوبات نطق ',
          'صعوبات تعلم ',
          'دورة ترجمة ',
          'حلاقة رجال م2 ',
          'حلاقة رجال م1 ',
          'حاسوب - الاتوكاد م2 ',
          'حاسوب - الاتوكاد م1 ',
          'تجميل سيدات م2 ',
          'تجميل سيدات م1 ',
          'تأسيس انجليزي ',
          'المكياج ',
          'اللغة العربية ',
          'العناية بالبشرة ',
          'الطباعة على الكمبيوتر ',
          'السكرتارية ',
          'التصميم الجرافيكي ',
          'التخطيط الوظيفي ',
          'التحدي انجليزي ',
          'البرمجيات الجاهزة ',
         ];

         for ($item=0; $item < count($cats); $item++) {
            foreach ($cats as $catss) {
             $catss = new Course_Cat;
             $catss->name = $cats[$item];
             $catss->save();
             $item+=1;
       }


    }
    }
}
