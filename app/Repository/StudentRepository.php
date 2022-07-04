<?php

namespace App\Repository;


use App\Http\Interfaces\StudentRepositoryInterface;
use App\Models\Grade as GradeModel;
use App\Models\Image as ImageModel;
use App\Models\MyParent as ParentModel;
use App\Models\Student as StudentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class StudentRepository implements StudentRepositoryInterface
{
    protected $students;
    protected $grades;
    protected $parents;
    protected $images;

    public function __construct(StudentModel $students, GradeModel $grades, ParentModel $parents, ImageModel $images)
    {
        $this->students = $students;
        $this->grades = $grades;
        $this->parents = $parents;
        $this->images = $images;
    }

    public function index()
    {
        $students = $this->students->with('grade', 'section', 'classroom')->get();
        return view('page.students.index', ['students' => $students]);
    }

    public function create()
    {
        $grades = $this->grades->all();
        $parents = $this->parents->all();
        return view('page.students.create', ['grades' => $grades, 'parents' => $parents]);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $students = $this->students->create([
                'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'gender_id' => $request->gender_id,
                'blood_id' => $request->blood_id,
                'date_birth' => $request->date_birth,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id,
                'academic_year' => $request->academic_year,
            ]);

            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {

                    $this->images->create([
                        'filename' => upload_image('students/' . $students->name, $file),
                        'imageable_id' => $students->id,
                        'imageable_type' => 'App\Models\Student',
                    ]);
                }
            }

            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('students.index');
        }
    }

    public function show($id)
    {
        $student = $this->students->with('images')->findorfail($id);
        return view('page.students.show', ['student' => $student]);
    }

    public function edit($id)
    {
        $student = $this->students->findOrFail($id);
        $grades = $this->grades->all();
        $parents = $this->parents->all();
        return view('page.students.edit', ['grades' => $grades, 'parents' => $parents, 'student' => $student]);
    }

    public function update($request, $id)
    {

        $students = $this->students->findorfail($id);
        $students->update([
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gender_id' => $request->gender_id,
            'blood_id' => $request->blood_id,
            'date_birth' => $request->date_birth,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
            'parent_id' => $request->parent_id,
            'academic_year' => $request->academic_year,
        ]);
        toastr()->success(__('messages.update'));
        return redirect()->route('students.index');
    }


    public function destroy($id)
    {
        $students = $this->students->findOrFail($id);
        if ($students->delete()) {

            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);
    }

    public function upload_attachment($request)
    {
        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $file) {

                $this->images->create([
                    'filename' => upload_image('students/' . $request->student_name, $file),
                    'imageable_id' => $request->student_id,
                    'imageable_type' => 'App\Models\Student',
                ]);
            }
            toastr()->success(__('messages.success'));
            return redirect()->route('students.show', $request->student_id);
        }
        toastr()->success(__('messages.error'));
        return redirect()->route('students.show', $request->student_id);
    }

    public function download_attachment($id)
    {
        $images = $this->images->findOrfail($id);
        $image = Str::after($images->filename, 'storage/students/');
        return response()->download(storage_path('app/public/students/' . $image));
    }

    public function destroy_attachment($id)
    {
        $images = $this->images->findOrfail($id);
        $image = Str::after($images->filename, 'storage/');
        Storage::disk('public')->delete($image);

        if ($images->delete()) {
            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);
    }

}
