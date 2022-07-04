<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\GradeRepositoryInterface;
use App\Http\Requests\GradeRequest;
use App\Models\Grade as GradeModel;

class GradeController extends Controller
{

    protected $grade;

    public function __construct(GradeRepositoryInterface $grade)
    {
        $this->grade = $grade;
    }

    public function index()
    {
        return $this->grade->index();
    }

    public function create()
    {
        return $this->grade->create();
    }


    public function store(GradeRequest $request)
    {
        return $this->grade->store($request);
    }

    public function edit($id)
    {
        return $this->grade->edit($id);
    }

    public function update(GradeRequest $request, $id)
    {
        return $this->grade->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->grade->destroy($id);
    }
}

?>
