<?php

namespace Database\Seeders;

use App\Models\MyParent;
use Illuminate\Database\Seeder;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MyParent::create([
            'email'=>'QasimSalah@gmail@com',
            'password'=>bcrypt('Qasim Salah'),
            'name_father'=> ['en' => 'َQasim', 'ar' => ' قاسم '],
            'phone_father'=>'7702814484',
            'job_father'=>['en' => 'programmer', 'ar' => 'مبرمج'],
            'blood_type_father_id'=>1,
            'address_father'=>'بغداد',
            'name_mother'=>['en' => 'ss', 'ar' => 'سس'],
            'phone_mother'=>'7502814484',
            'job_mother' =>['en' => 'Teacher', 'ar' => 'معلمة'],
            'blood_type_mother_id'=>2,
            'address_mother'=>'بغداد',
        ]);
    }
}
