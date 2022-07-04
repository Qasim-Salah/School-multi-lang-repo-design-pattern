<?php

namespace App\Repository;

use App\Http\Interfaces\GradeRepositoryInterface;
use App\Models\Classroom as ClassModel;
use App\Models\Grade as GradeModel;


class GradeRepository implements GradeRepositoryInterface
{

    protected $grade;
    protected $classes;

    public function __construct(GradeModel $grade, ClassModel $classes)
    {
        $this->grade = $grade;
        $this->classes = $classes;
    }

    public function index()
    {
        $grades = $this->grade->all();
        return view('page.grades.index', ['grades' => $grades]);
    }

    public function create()
    {
        return view('page.grades.create');
    }

    public function store($request)
    {
        $this->grade->create([
            'name' => ['en' => $request->name_en, 'ar' => $request->name],
            'notes' => $request->notes,
        ]);
        toastr()->success(__('messages.success'));
        return redirect()->route('grades.index');
    }

    public function edit($id)
    {
        $grade = $this->grade->findOrfail($id);
        return view('page.grades.edit', ['grade' => $grade]);
    }

    public function update($request, $id)
    {
        $grade = $this->grade->findOrfail($id);

        $grade->update([
            'name' => ['en' => $request->name_en, 'ar' => $request->name],
            'notes' => $request->notes,
        ]);

        toastr()->success(__('messages.update'));
        return redirect()->route('grades.index');
    }

    public function destroy($id)
    {
        $class = $this->classes->where('grade_id', $id)->pluck('grade_id');
        if ($class->count() == 0) {
            $grade = $this->grade->findOrfail($id)->delete();

            if ($grade) {
                return response()->json(['message' => __('messages.delete')]);
            }
        }
        return response()->json(['message' => __('messages.unDelete')], 422);

    }

}
