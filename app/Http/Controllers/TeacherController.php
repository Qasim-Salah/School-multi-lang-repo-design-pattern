<?php

namespace App\Http\Controllers;


use App\Http\Interfaces\TeacherRepositoryInterface;
use App\Http\Requests\TeachersRequests;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }

    public function index()
    {
        return $this->teacher->index();
    }

    public function create()
    {
        return $this->teacher->create();
    }

    public function store(TeachersRequests $request)
    {
        return $this->teacher->store($request);
    }

    public function edit($id)
    {
        return $this->teacher->edit($id);
    }

    public function update(TeachersRequests $request, $id)
    {
        return $this->teacher->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->teacher->destroy($id);
    }
}
