<?php

namespace App\Repository;


use App\Http\Interfaces\FeesInvoicesRepositoryInterface;
use App\Models\Fee as FeeModel;
use App\Models\FeeInvoices as InvoicesModel;
use App\Models\Student as StudentModel;
use App\Models\StudentAccount as StudentAccountModel;
use Illuminate\Support\Facades\DB;


class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface
{
    protected $invoices;
    protected $students;
    protected $fees;
    protected $studentAccount;

    public function __construct(InvoicesModel $invoices, StudentModel $students, FeeModel $fees, StudentAccountModel $studentAccount)
    {
        $this->invoices = $invoices;
        $this->students = $students;
        $this->fees = $fees;
        $this->studentAccount = $studentAccount;
    }

    public function index()
    {
        $invoices = $this->invoices->with(['grade', 'classroom', 'student', 'fees'])->get();
        return view('page.fees.invoices.index', ['invoices' => $invoices]);
    }

    public function create($id)
    {
        $student = $this->students->findorfail($id);
        $fees = $this->fees->where('classroom_id', $student->classroom_id)->get();
        return view('page.fees.invoices.create', ['fees' => $fees, 'student' => $student]);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $fees = $this->invoices->create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'fee_id' => $request->fee_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            $this->studentAccount->create([
                'date' => date('Y-m-d'),
                'type' => 'invoice',
                'fee_invoice_id' => $fees->id,
                'student_id' => $request->student_id,
                'debit' => $request->amount,
                'credit' => 0.00,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('fees.invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('fees.invoices.index');
        }
    }

    public function edit($id)
    {
        $invoice = $this->invoices->with('student')->findorfail($id);
        $fees = $this->fees->where('classroom_id', $invoice->classroom_id)->get();
        return view('page.fees.invoices.edit', ['invoice' => $invoice, 'fees' => $fees]);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $invoices = $this->invoices->findorfail($id);

            $invoices->update([
                'fee_id' => $request->fee_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            $StudentAccount = $this->studentAccount->where('fee_invoice_id', $request->id)->first();
            $StudentAccount->update([
                'Debit' => $request->amount,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(__('messages.update'));
            return redirect()->route('fees.invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('fees.invoices.index');
        }
    }

    public function destroy($id)
    {
        $invoices = $this->invoices->findorfail($id);
        $invoices->student_account()->delete();

        if ($invoices->delete()) {
            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);
    }

}
