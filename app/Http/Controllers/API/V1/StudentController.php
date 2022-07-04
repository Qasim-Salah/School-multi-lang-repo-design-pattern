<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Section as SectionModel;

class StudentController extends Controller
{
    public function sectionsFind($id)
    {
        $sections = SectionModel::where('class_id', $id)->pluck("name", "id");

        return json_encode($sections);
    }
}
