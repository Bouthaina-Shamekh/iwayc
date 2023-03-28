<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeacherSpecializations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherSpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
        'التجميل',
        'الحلاقة',
        'تسويق',
        'حاسوب',
        'خلويات',
        'شريعة',
        'فيزياء',
        'محاسبة',
        'هندسة',
        'انجليزي',
        'رياضيات',
        ' لغة عربية',
        'تربية خاصة ',
        'ادارة وتنمية بشرية',
        'اخرى',];

        for ($item=0; $item < count($states); $item++) {
             foreach ($states as $TeacherSpecializations) {
              $TeacherSpecializations = new TeacherSpecializations;
              $TeacherSpecializations->name = $states[$item];
              $TeacherSpecializations->save();
              $item+=1;
        }


     }
    }
}



