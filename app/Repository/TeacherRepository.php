<?php

namespace App\Repository;

use App\Http\Interfaces\TeacherRepositoryInterface;
use App\Models\Teacher as TeacherModel;

class TeacherRepository implements TeacherRepositoryInterface
{
    protected $teacher;

    public function __construct(TeacherModel $teacher)
    {
        $this->teacher = $teacher;
    }

    public function index()
    {
        $teachers = $this->teacher->all();
        return view('page.teachers.index', ['teachers' => $teachers]);
    }

    public function create()
    {
        return view('page.teachers.create');
    }

    public function store($request)
    {
        $this->teacher->create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'specialization_id' => $request->specialization_id,
            'gender_id' => $request->gender_id,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
        ]);

        toastr()->success(__('messages.success'));
        return redirect()->route('teachers.index');
    }

    public function edit($id)
    {
        $teacher = $this->teacher->findOrFail($id);
        return view('page.teachers.edit', ['teacher' => $teacher]);
    }

    public function update($request, $id)
    {
        $teachers = $this->teacher->findOrFail($id);
        $teachers->update([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'specialization_id' => $request->specialization_id,
            'gender_id' => $request->gender_id,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
        ]);

        toastr()->success(__('messages.update'));
        return redirect()->route('teachers.index');
    }

    public function destroy($id)
    {
        $teacher = $this->teacher->findOrFail($id)->delete();
        if ($teacher) {
            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);
    }
}
