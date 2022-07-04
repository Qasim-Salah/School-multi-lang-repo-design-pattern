<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Classroom as ClassModel;


class SectionController extends Controller
{
    public function classesFind($id)
    {
        $classes = ClassModel::where("grade_id", $id)->pluck("name", "id");

        return json_encode($classes);
    }
}
