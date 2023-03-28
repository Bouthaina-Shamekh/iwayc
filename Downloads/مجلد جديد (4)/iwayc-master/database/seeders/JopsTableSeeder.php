<?php

namespace Database\Seeders;

use App\Models\Jops;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $jops = [
            'اداري' ,
            'مترجم',
            'مراسل',
            'سكرتيرة',
            'معلم واداري',
            'تسويق ميداني',
            'تسويق الكتروني',
            'توزيع اعلانات على الدوار'];

            for ($item=0; $item < count($jops); $item++) {
                 foreach ($jops as $jop) {
                  $jop = new Jops;
                  $jop->name = $jops[$item];
                  $jop->save();
                  $item+=1;
            }


         }
    }
}

