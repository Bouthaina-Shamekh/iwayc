<?php

namespace Database\Seeders;

use App\Models\Adress;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adress = [
        'جاوا' ,
        'زيزيا',
        'سحاب',
        'مادبا',
        'الجويدة',
        'الوحدات',
        'اليادودة',
        'محافظات',
        'الدبايبة',
        'القويسمة',
        'المقابلين',
        'ابو علندا',
        'عمان -اخرى',
        'جبل الزهور',
        'وزارة العمل',
        'خريبة السوق ',
        'خارج المملكة ',
        '*مجموعة مناطق',
        'وزارة التربية',
        'ضاحية الحاج حسن',
        'دوار الشرق الاوسط',];

        for ($item=0; $item < count($adress); $item++) {
             foreach ($adress as $adres) {
              $adres = new Adress;
              $adres->name = $adress[$item];
              $adres->save();
              $item+=1;
        }


     }
    }
}
