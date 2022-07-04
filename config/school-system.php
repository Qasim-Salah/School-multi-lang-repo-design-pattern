<?php

return [
//    'gender' => [['name' => 'ذكر', 'id' => 1], ['name' => 'انثى', 'id' => 2]],
    'gender' => [
        ['name_en' => 'Male', 'name_ar' => 'ذكر', 'id' => 1],
        ['name_en' => 'Female', 'name_ar' => 'انثي', 'id' => 2],
    ],

    'setting' => [
        ['key' => 'client_referral', 'name' => 'شلون عرف بينة الزبون'],
        ['key' => 'client_type', 'name' => 'نوع العميل'],
        ['key' => 'client_job', 'name' => 'مهنة العميل'],
        ['key' => 'worker_referral', 'name' => 'شلون عرف بينة العامل'],
        ['key' => 'worker_type', 'name' => 'نوع العامل'],
        ['key' => 'education_level', 'name' => 'الشهادة'],
        ['key' => 'transport_type', 'name' => 'نوع وسيلة النقل الحرفي'],
    ],
    'general_status' => [
        ['name' => 'فعال', 'name_en' => 'active', 'id' => 1, 'class' => 'badge bg-success font-size-18'],
        ['name' => 'غير فعال', 'name_en' => 'unActive', 'id' => 0, 'class' => 'badge bg-danger font-size-18'],
    ],
    'blood_types' => [
        ['name' => 'O-', 'id' => 1],
        ['name' => 'O+', 'id' => 2],
        ['name' => 'A+', 'id' => 3],
        ['name' => 'A-', 'id' => 4],
        ['name' => 'B+', 'id' => 5],
        ['name' => 'B-', 'id' => 6],
        ['name' => 'AB+', 'id' => 7],
        ['name' => 'AB-', 'id' => 8],
    ],
    'specializations' => [
        ['name_en' => 'Arabic', 'name_ar' => 'عربي', 'id' => 1],
        ['name_en' => 'Sciences', 'name_ar' => 'علوم', 'id' => 2],
        ['name_en' => 'Computer', 'name_ar' => 'حاسب الي', 'id' => 3],
        ['name_en' => 'English', 'name_ar' => 'انجليزي', 'id' => 4],
    ],
];
