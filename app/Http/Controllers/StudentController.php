<?php

namespace App\Http\Controllers;


use App\Http\Interfaces\StudentRepositoryInterface;
use App\Http\Requests\StudentRequests;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        return $this->student->index();
    }

    public function create()
    {
        return $this->student->create();
    }

    public function store(StudentRequests $request)
    {
        return $this->student->store($request);
    }

    public function show($id)
    {
        return $this->student->show($id);
    }

    public function edit($id)
    {
        return $this->student->edit($id);
    }

    public function update(StudentRequests $request, $id)
    {
        return $this->student->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->student->destroy($id);
    }

    public function upload_attachment(Request $request)
    {
        return $this->student->upload_attachment($request);
    }

    public function download_attachment($id)
    {
        return $this->student->download_attachment($id);
    }

    public function destroy_attachment($id)
    {
        return $this->student->destroy_attachment($id);
    }

}
