<?php

namespace Database\Seeders;

use App\Models\HowListen;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HowListenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ' ارمة المركز',
            ' اعلان اشارات الدوار',
            ' اعلان سوق الوحدات',
            ' اعلان محال تجارية',
            ' اعلان مدرسة',
            ' اعلان مسجد ',
            '  الفيسبوك',
            ' الموقع الالكتروني للمركز',
            ' تسويق هاتفي',
            ' زبائن الترجمة ',
            ' عن طريق صديق',
            '  فيسبوك - اعلان ممول ',
            ' لوحة اعمدة الكهرباء  ',
            'اخرى',];

            for ($item=0; $item < count($states); $item++) {
                 foreach ($states as $state) {
                  $state = new HowListen;
                  $state->name = $states[$item];
                  $state->save();
                  $item+=1;
            }
    }
  }
}


