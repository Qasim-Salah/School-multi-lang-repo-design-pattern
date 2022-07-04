<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ClassRepositoryInterface;
use App\Http\Requests\ClassroomRequest;

class ClassroomController extends Controller
{

    protected $class;

    public function __construct(ClassRepositoryInterface $class)
    {
        $this->class = $class;
    }

    public function index()
    {
        return $this->class->index();
    }

    public function create()
    {
        return $this->class->create();
    }

    public function store(ClassroomRequest $request)
    {
        return $this->class->store($request);
    }

    public function edit($id)
    {
        return $this->class->edit($id);
    }

    public function update(ClassroomRequest $request, $id)
    {
        return $this->class->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->class->destroy($id);
    }

}
