<?php

/**
 *Upload Image In Local Storage.
 * @param  $folder
 * @param $image
 */

use App\Models\Classroom;
use App\Models\Section;

if (!function_exists('upload_image')) {
    function upload_image($folder, $image)
    {
        $store = \Illuminate\Support\Facades\Storage::disk('public')->put($folder, $image);
        $url = \Illuminate\Support\Facades\Storage::disk('public')->url($store);
        return $url;
    }

    if (!function_exists('filter_phone')) {
        function filter_phone($phoneNumber)
        {
            $phoneNumber = str_replace('+', '', $phoneNumber);
            $phoneNumber = preg_replace('/^00964/', '', $phoneNumber);
            $phoneNumber = preg_replace('/^964/', '', $phoneNumber);
            $phoneNumber = preg_replace('/^079/', '79', $phoneNumber);
            $phoneNumber = preg_replace('/^078/', '78', $phoneNumber);
            $phoneNumber = preg_replace('/^077/', '77', $phoneNumber);
            $phoneNumber = preg_replace('/^076/', '77', $phoneNumber);
            $phoneNumber = preg_replace('/^075/', '75', $phoneNumber);
            return $phoneNumber;
        }
    }
    if (!function_exists('class_room')) {
        function class_room($id)
        {
            return Classroom::where('grade_id', $id)->get();
        }
    }

    if (!function_exists('sections')) {
        function sections($id)
        {
            return Section::where('class_id', $id)->get();
        }
    }
}


