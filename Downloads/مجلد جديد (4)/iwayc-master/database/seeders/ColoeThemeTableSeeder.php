<?php

namespace Database\Seeders;

use App\Models\ColorTheme;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColoeThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       ColorTheme::create([
            'mode' => 'dark',
            ]);
    }
}
