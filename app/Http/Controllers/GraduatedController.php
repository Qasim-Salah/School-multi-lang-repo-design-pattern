<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\StudentGraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    protected $graduated;

    public function __construct(StudentGraduatedRepositoryInterface $graduated)
    {
        $this->graduated = $graduated;
    }

    public function index()
    {
        return $this->graduated->index();
    }

    public function create()
    {
        return $this->graduated->create();
    }

    public function store(Request $request)
    {
        return $this->graduated->SoftDelete($request);
    }

    public function update(Request $request)
    {
        return $this->graduated->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->graduated->destroy($request);
    }
}
