<?php

namespace Database\Seeders;

use App\Models\Classroom as ClassModel;
use App\Models\Grade as GradeModel;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classrooms = [
            ['en' => 'First grade', 'ar' => 'الصف الاول'],
            ['en' => 'Second grade', 'ar' => 'الصف الثاني'],
            ['en' => 'Third grade', 'ar' => 'الصف الثالث'],
            ['en' => 'fourth grade', 'ar' => 'الصف الرابع'],
            ['en' => 'fifth grade', 'ar' => 'الصف الخامس'],
            ['en' => 'Sixth grade', 'ar' => 'الصف السادس'],
        ];
            foreach ($classrooms as $classroom) {
                ClassModel::create([
                    'name' => $classroom,
                    'grade_id' => GradeModel::all()->unique()->random()->id
                ]);
        }
    }
}
