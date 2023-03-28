<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ColoeThemeTableSeeder::class);
        $this->call(SkillsTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(JopsTableSeeder::class);
        $this->call(AdressTableSeeder::class);
        $this->call(CreateCourse_CatSeeder::class);
        $this->call(TeacherSpecializationsTableSeeder::class);
        $this->call(HowListenTableSeeder::class);
        $this->call(EnglishLevelTableSeeder::class);
    }
}
