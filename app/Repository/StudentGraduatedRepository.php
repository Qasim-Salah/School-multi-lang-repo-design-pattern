<?php

namespace App\Repository;

use App\Http\Interfaces\StudentGraduatedRepositoryInterface;
use App\Models\Classroom as ClassModel;
use App\Models\Grade as GradeModel;
use App\Models\Section as SectionModel;
use App\Models\Student as StudentModel;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{
    protected $students;
    protected $grades;

    public function __construct(StudentModel $students, GradeModel $grades)
    {
        $this->students = $students;
        $this->grades = $grades;
    }

    public function index()
    {
        $students = $this->students->with('grade', 'section', 'classroom')->onlyTrashed()->get();
        return view('page.students.graduated.index', ['students' => $students]);
    }

    public function create()
    {
        $grades = $this->grades->all();
        return view('page.students.graduated.create', ['grades' => $grades]);
    }

    public function SoftDelete($request)
    {
        $students = $this->students->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)
            ->get();

        if ($students->count() < 1) {
            toastr()->success(__('messages.error'));
            return redirect()->route('graduated.index');
        }

        foreach ($students as $student) {
            $ids = explode(',', $student->id);
            $this->students->whereIn('id', $ids)->delete();
        }

        toastr()->success(__('messages.delete'));
        return redirect()->route('graduated.index');
    }

    public function update($request)
    {
        $this->students->onlyTrashed()->findOrfail($request->id)->restore();

        toastr()->success(__('messages.update'));
        return redirect()->route('graduated.index');
    }

    public function destroy($request)
    {
        $this->students->onlyTrashed()->findOrFail($request->id)->forceDelete();

        toastr()->success(__('messages.delete'));
        return redirect()->route('graduated.index');
    }


}
