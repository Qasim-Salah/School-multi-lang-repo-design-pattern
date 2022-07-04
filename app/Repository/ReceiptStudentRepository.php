<?php

namespace App\Repository;


use App\Http\Interfaces\ReceiptStudentsRepositoryInterface;
use App\Models\FundAccount as FundAccountModel;
use App\Models\ReceiptStudent as ReceiptModel;
use App\Models\Student as StudentModel;
use App\Models\StudentAccount as StudentAccountModel;
use Illuminate\Support\Facades\DB;


class ReceiptStudentRepository implements ReceiptStudentsRepositoryInterface
{
    protected $receipts;
    protected $student;
    protected $studentAccount;
    protected $fundAccount;


    public function __construct(ReceiptModel $receipts, StudentModel $student, StudentAccountModel $studentAccount, FundAccountModel $fundAccount)
    {
        $this->receipts = $receipts;
        $this->student = $student;
        $this->studentAccount = $studentAccount;
        $this->fundAccount = $fundAccount;
    }

    public function index()
    {
        $receipts = $this->receipts->with('student')->get();
        return view('page.students.receipt.index', ['receipts' => $receipts]);
    }

    public function create($id)
    {
        $student = $this->student->findorfail($id);
        return view('page.students.receipt.create', ['student' => $student]);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $receipts = $this->receipts->create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'debit' => $request->debit,
                'description' => $request->description,
            ]);

            $this->fundAccount->create([
                'date' => date('Y-m-d'),
                'receipt_id' => $receipts->id,
                'debit' => $request->debit,
                'credit' => 0.00,
                'description' => $request->description,
            ]);

            $this->studentAccount->create([
                'date' => date('Y-m-d'),
                'type' => 'receipt',
                'receipt_id' => $receipts->id,
                'student_id' => $request->student_id,
                'debit' => 0.00,
                'credit' => $request->debit,
                'description' => $request->description,
            ]);

            DB::commit();

            toastr()->success(__('messages.success'));
            return redirect()->route('students.receipts.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('students.receipts.index');
        }
    }

    public function edit($id)
    {
        $receipt = $this->receipts->findorfail($id);
        return view('page.students.receipt.edit', ['receipt' => $receipt]);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $receipt = $this->receipts->findorfail($id);
            $receipt->update([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'debit' => $request->debit,
                'description' => $request->description,
            ]);

            $fund_account = $this->fundAccount->where('receipt_id', $id)->first();
            $fund_account->update([
                'date' => date('Y-m-d'),
                'receipt_id' => $receipt->id,
                'debit' => $request->debit,
                'credit' => 0.00,
                'description' => $request->description,
            ]);

            $student_account = $this->studentAccount->where('receipt_id', $id)->first();
            $student_account->update([
                'date' => date('Y-m-d'),
                'type' => 'receipt',
                'receipt_id' => $receipt->id,
                'student_id' => $request->student_id,
                'debit' => 0.00,
                'credit' => $request->debit,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(__('messages.update'));
            return redirect()->route('students.receipts.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('students.receipts.index');
        }
    }

    public function destroy($id)
    {
        $receipts = $this->receipts->findorfail($id);
        $receipts->student_account()->delete();
        $receipts->fund_account()->delete();

        if ($receipts->delete()) {
            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);

    }
}
