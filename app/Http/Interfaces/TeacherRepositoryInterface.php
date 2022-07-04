<?php

namespace App\Http\Interfaces;

interface TeacherRepositoryInterface
{

    // get all Teachers
    public function index();

    public function create();

    // TeachersRequests
    public function store($request);

    // TeachersRequests
    public function edit($id);

    // UpdateTeachers
    public function update($request, $id);

    // DeleteTeachers
    public function destroy($id);

}


