<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
//        Grade::truncate()
        $this->call([
            UserSeeder::class,
            GradeSeeder::class,
            ClassroomSeeder::class,
            SectionSeeder::class,
            ParentSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
