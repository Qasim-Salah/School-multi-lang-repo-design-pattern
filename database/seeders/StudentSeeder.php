<?php

namespace Database\Seeders;

use App\Models\Classroom as ClassModel;
use App\Models\Grade as GradeModel;
use App\Models\MyParent as ParentModel;
use App\Models\Section as SectionModel;
use App\Models\Student as StudentModel;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentModel::create([
            'name' => ['ar' => 'احمد ابراهيم', 'en' => 'Ahmed Ibrahim'],
            'email' => 'Ahmed_Ibrahim@yahoo.com',
            'password' => bcrypt('Qasim Salah'),
            'gender_id' => 1,
            'blood_id' => 1,
            'date_Birth' => date('1995-01-01'),
            'grade_id' => GradeModel::all()->unique()->random()->id,
            'classroom_id' => ClassModel::all()->unique()->random()->id,
            'section_id' => SectionModel::all()->unique()->random()->id,
            'parent_id' => ParentModel::all()->unique()->random()->id,
            'academic_year' => '2021',
        ]);
    }
}
