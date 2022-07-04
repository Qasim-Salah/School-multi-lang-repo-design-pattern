<?php

namespace App\Repository;

use App\Http\Interfaces\SectionRepositoryInterface;
use App\Models\Grade as GradeModel;
use App\Models\Section as SectionModel;
use App\Models\Teacher as TeacherModel;
use Illuminate\Support\Facades\DB;


class SectionRepository implements SectionRepositoryInterface
{
    protected $sections;
    protected $grades;
    protected $teachers;

    public function __construct(SectionModel $sections, GradeModel $grades, TeacherModel $teachers)
    {
        $this->sections = $sections;
        $this->grades = $grades;
        $this->teachers = $teachers;
    }

    public function index()
    {
        $sections = $this->sections->with('classs')->get();
        return view('page.sections.index', ['sections' => $sections]);
    }

    public function create()
    {
        $grades = $this->grades->all();
        $teachers = $this->teachers->all();
        return view('page.sections.create', ['teachers' => $teachers, 'grades' => $grades]);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $sections = $this->sections->create([
                'name' => ['ar' => $request->name, 'en' => $request->name_en],
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'status' => 1,
            ]);

            $sections->teachers()->syncWithoutDetaching($request->teacher_id);

            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('sections.index');
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('sections.index');
        }
    }

    public function edit($id)
    {
        $section = $this->sections->findOrfail($id);
        $grades = $this->grades->all();
        $teachers = $this->teachers->all();
        return view('page.sections.edit', ['section' => $section, 'grades' => $grades, 'teachers' => $teachers]);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $section = $this->sections->findOrfail($id);

            $section->update([
                'name' => ['ar' => $request->name, 'en' => $request->name_en],
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'status' => $request->status,
            ]);

            if (isset($request->teacher_id)) {
                $section->teachers()->sync($request->teacher_id);
            } else {
                $section->teachers()->sync(array());
            }
            DB::commit();
            toastr()->success(__('messages.update'));
            return redirect()->route('sections.index');
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('sections.index');
        }
    }

    public function destroy($id)
    {
        $sections = $this->sections->findOrFail($id);

        $sections->teachers()->detach();
        if ($sections->delete()) {
            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);
    }

}
