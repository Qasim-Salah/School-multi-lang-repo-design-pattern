<?php

namespace App\Repository;


use App\Http\Interfaces\FeesRepositoryInterface;
use App\Models\Fee as FeeModel;
use App\Models\Grade as GradeModel;

class FeesRepository implements FeesRepositoryInterface
{
    protected $grade;
    protected $fees;

    public function __construct(GradeModel $grade, FeeModel $fees)
    {
        $this->grade = $grade;
        $this->fees = $fees;
    }

    public function index()
    {
        $fees = $this->fees->with(['grade', 'classroom'])->get();
        return view('page.fees.index', ['fees' => $fees]);
    }

    public function create()
    {
        $grades = $this->grade->all();
        return view('page.fees.create', ['grades' => $grades]);
    }

    public function store($request)
    {
        $this->fees->create([
            'title' => ['en' => $request->title_en, 'ar' => $request->title_ar],
            'amount' => $request->amount,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'description' => $request->description,
            'year' => $request->year,
            'type' => $request->type,
        ]);

        toastr()->success(__('messages.success'));
        return redirect()->route('fees.index');
    }

    public function edit($id)
    {
        $fee = $this->fees->findOrfail($id);
        $grades = $this->grade->all();
        return view('page.fees.edit', ['fee' => $fee, 'grades' => $grades]);
    }

    public function update($request, $id)
    {
        $fees = $this->fees->findOrfail($id);
        $fees->update([
            'title' => ['en' => $request->title_en, 'ar' => $request->title_ar],
            'amount' => $request->amount,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'description' => $request->description,
            'year' => $request->year,
            'type' => $request->type,
        ]);

        toastr()->success(__('messages.update'));
        return redirect()->route('fees.index');
    }

    public function destroy($id)
    {
        $fee = $this->fees->findOrfail($id);

        if ($fee->delete()) {
            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);
    }
}
