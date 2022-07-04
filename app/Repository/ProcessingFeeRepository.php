<?php

namespace App\Repository;

use App\Http\Interfaces\ProcessingFeeRepositoryInterface;
use App\Models\ProcessingFee as ProcessingModel;
use App\Models\Student as StudentModel;
use App\Models\StudentAccount as StudentAccountModel;
use Illuminate\Support\Facades\DB;


class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{
    protected $processing;
    protected $student;
    protected $studentAccount;


    public function __construct(ProcessingModel $processing, StudentModel $student, StudentAccountModel $studentAccount)
    {
        $this->processing = $processing;
        $this->student = $student;
        $this->studentAccount = $studentAccount;
    }

    public function index()
    {
        $processings = $this->processing->with('student')->get();
        return view('page.fees.processings.index', ['processings' => $processings]);
    }

    public function create($id)
    {
        $student = $this->student->findorfail($id);
        return view('page.fees.processings.create', ['student' => $student]);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $processing = $this->processing->create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount' => $request->debit,
                'description' => $request->description,
            ]);

            $this->studentAccount->create([
                'date' => date('Y-m-d'),
                'type' => 'Processing',
                'student_id' => $request->student_id,
                'processing_id' => $processing->id,
                'debit' => 0.00,
                'credit' => $request->debit,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('fees.processings.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('fees.processings.index');
        }
    }

    public function edit($id)
    {
        $processing = $this->processing->findorfail($id);
        return view('page.fees.processings.edit', ['processing' => $processing]);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $processing = $this->processing->findorfail($id);
            $processing->update([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount' => $request->debit,
                'description' => $request->description,
            ]);

            // تعديل البيانات في جدول حساب الطلاب
            $student_account = $this->studentAccount->where('processing_id', $id)->first();
            $student_account->update([
                'date' => date('Y-m-d'),
                'type' => 'Processing',
                'student_id' => $request->student_id,
                'processing_id' => $processing->id,
                'debit' => 0.00,
                'credit' => $request->debit,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('fees.processings.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('fees.processings.index');
        }
    }

    public function destroy($id)
    {
        $receipts = $this->processing->findorfail($id);
        $receipts->student_account()->delete();

        if ($receipts->delete()) {
            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);

    }
}
