<?php

namespace App\Repository;

use App\Http\Interfaces\StudentPromotionRepositoryInterface;
use App\Models\Grade as GradeModel;
use App\Models\Promotion as PromotionModel;
use App\Models\Student as StudentModel;
use Illuminate\Support\Facades\DB;


class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    protected $students;
    protected $grades;
    protected $promotions;

    public function __construct(PromotionModel $promotions, StudentModel $students, GradeModel $grades)
    {
        $this->students = $students;
        $this->grades = $grades;
        $this->promotions = $promotions;
    }

    public function index()
    {
        $promotions = $this->promotions->with(['student', 'from_grade_r', 'from_classroom_r', 'to_classroom_r', 'to_section_r'])->get();
        return view('page.students.promotions.index', ['promotions' => $promotions]);
    }

    public function create()
    {
        $grades = $this->grades->all();
        return view('page.students.promotions.create', ['grades' => $grades]);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $students = $this->students->where('grade_id', $request->grade_id)
                ->where('classroom_id', $request->classroom_id)
                ->where('section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)
                ->get();

            // update in table student
            foreach ($students as $student) {

//                [1,2,3]
                $ids = explode(',', $student->id);
                $this->students->whereIn('id', $ids)
                    ->update([
                        'grade_id' => $request->grade_id_new,
                        'classroom_id' => $request->classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new,
                    ]);

                // insert in to promotions
                $this->promotions->updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->grade_id,
                    'from_classroom' => $request->classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->grade_id_new,
                    'to_classroom' => $request->classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('promotions.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('promotions.index');
        }
    }

    public function destroy($request)
    {
        if ($request->page_id == 1) {
            $promotions = $this->promotions->all();
            foreach ($promotions as $promotion) {

                $ids = explode(',', $promotion->student_id);
                $this->students->whereIn('id', $ids)
                    ->update([
                        'grade_id' => $promotion->from_grade,
                        'classroom_id' => $promotion->from_classroom,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->academic_year,
                    ]);

                $this->promotions->truncate();
            }
            toastr()->success(__('messages.delete'));
            return redirect()->route('promotions.index');

        }
            $promotion = $this->promotions->findorfail($request->id);
            $this->students->where('id', $promotion->student_id)
                ->update([
                    'grade_id' => $promotion->from_grade,
                    'classroom_id' => $promotion->from_classroom,
                    'section_id' => $promotion->from_section,
                    'academic_year' => $promotion->academic_year,
                ]);

            $this->promotions->destroy($request->id);
            toastr()->success(__('messages.delete'));
            return redirect()->route('promotions.index');
    }

}
