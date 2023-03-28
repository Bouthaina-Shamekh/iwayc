<?php

namespace Database\Seeders;

use App\Models\EnglishLevel;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EnglishLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            'مستوى 1',
            '2 مستوى ',
            '3 مستوى',
            '4 مستوى',
            '5 مستوى',
            '6 مستوى',
            '7 مستوى',
            '8 مستوى',];

            for ($item=0; $item < count($states); $item++) {
                 foreach ($states as $state) {
                  $state = new EnglishLevel;
                  $state->name = $states[$item];
                  $state->save();
                  $item+=1;
            }
    }
  }
}
