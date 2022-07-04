<?php

namespace Database\Seeders;

use App\Models\Classroom as ClassModel;
use App\Models\Grade as GradeModel;
use App\Models\Section as SectionModel;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Sections = [
            ['en' => 'a', 'ar' => 'ا'],
            ['en' => 'b', 'ar' => 'ب'],
            ['en' => 'c', 'ar' => 'ت'],
        ];

        foreach ($Sections as $section) {
            SectionModel::create([
                'name' => $section,
                'status' => 1,
                'grade_id' => GradeModel::all()->unique()->random()->id,
                'class_id' => ClassModel::all()->unique()->random()->id,
            ]);
        }
    }

}

