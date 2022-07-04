<?php

namespace Database\Seeders;

use App\Models\Grade as GradeModel;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            ['en' => 'Primary stage', 'ar' => 'المرحلة الابتدائية'],
            ['en' => 'middle School', 'ar' => 'المرحلة الاعدادية'],
            ['en' => 'High school', 'ar' => 'المرحلة الثانوية'],
            ['en' => 'evening stage', 'ar' => 'المرحلة المسائية'],
        ];

        foreach ($grades as $grade) {
            GradeModel::create(['name' => $grade]);
        }
    }
}
