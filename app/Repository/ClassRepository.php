<?php

namespace App\Repository;

use App\Http\Interfaces\ClassRepositoryInterface;
use App\Models\Classroom as ClassModel;
use App\Models\Grade as GradeModel;

class ClassRepository implements ClassRepositoryInterface
{
    protected $class;
    protected $grades;

    public function __construct(ClassModel $class, GradeModel $grades)
    {
        $this->class = $class;
        $this->grades = $grades;
    }

    public function index()
    {
        $classes = $this->class->with('grade')->get();
        return view('page.class-room.index', ['classes' => $classes]);
    }

    public function create()
    {
        $grades = $this->grades->all();
        return view('page.class-room.create', ['grades' => $grades]);
    }

    public function store($request)
    {
        $this->class->create([
            'name' => ['en' => $request->name_en, 'ar' => $request->name],
            'grade_id' => $request->grade_id,
        ]);
        toastr()->success(__('messages.success'));
        return redirect()->route('class-room.index');
    }

    public function edit($id)
    {
        $class = $this->class->findOrfail($id);
        $grades = $this->grades->all();
        return view('page.class-room.edit', ['grades' => $grades, 'class' => $class]);
    }

    public function update($request, $id)
    {
        $class = $this->class->findOrfail($id);
        $class->update([
            'name' => ['en' => $request->name_en, 'ar' => $request->name],
            'grade_id' => $request->grade_id,
        ]);
        toastr()->success(__('messages.update'));
        return redirect()->route('class-room.index');
    }

    public function destroy($id)
    {
        $class = $this->class->findOrfail($id)->delete();
        if ($class) {
            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);
    }
}
