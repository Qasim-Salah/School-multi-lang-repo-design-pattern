<?php

namespace App\Repository;

use App\Http\Interfaces\PaymentRepositoryInterface;
use App\Models\FundAccount as FundAccountModel;
use App\Models\Payment as PaymentModel;
use App\Models\Student as StudentModel;
use App\Models\StudentAccount as StudentAccountModel;
use Illuminate\Support\Facades\DB;


class PaymentRepository implements PaymentRepositoryInterface
{
    protected $payments;
    protected $students;
    protected $studentAccount;
    protected $fundAccount;

    public function __construct(PaymentModel $payments, StudentModel $students, StudentAccountModel $studentAccount, FundAccountModel $fundAccount)
    {
        $this->payments = $payments;
        $this->students = $students;
        $this->studentAccount = $studentAccount;
        $this->fundAccount = $fundAccount;
    }

    public function index()
    {
        $payments = $this->payments->with('student')->get();
        return view('page.payment.index', ['payments' => $payments]);
    }

    public function create($id)
    {
        $student = $this->students->findorfail($id);
        return view('page.payment.create', ['student' => $student]);
    }

    public function edit($id)
    {
        $payment = $this->payments->findorfail($id);
        return view('page.payment.edit', ['payment' => $payment]);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $payments = $this->payments->create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount' => $request->debit,
                'description' => $request->description
            ]);

            $this->fundAccount->create([
                'date' => date('Y-m-d'),
                'payment_id' => $payments->id,
                'debit' => 0.00,
                'credit' => $request->debit,
                'description' => $request->description
            ]);

            $this->studentAccount->create([
                'date' => date('Y-m-d'),
                'type' => 'payment',
                'student_id' => $request->student_id,
                'payment_id' => $payments->id,
                'debit' => $request->debit,
                'credit' => 0.00,
                'description' => $request->description,
            ]);

            DB::commit();

            toastr()->success(__('messages.success'));
            return redirect()->route('payments.index');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            toastr()->success(__('messages.error'));
            return redirect()->route('payments.index');
        }
    }

    public function update($request, $id)
    {
        try {

            DB::beginTransaction();
            $payments = $this->payments->findorfail($id);
            $payments->update([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount' => $request->debit,
                'description' => $request->description
            ]);

            $fund_accounts = $this->fundAccount->where('payment_id', $request->id)->first();
            $fund_accounts->update([
                'date' => date('Y-m-d'),
                'payment_id' => $payments->id,
                'debit' => 0.00,
                'credit' => $request->debit,
                'description' => $request->description
            ]);

            $students_accounts = $this->studentAccount->where('payment_id', $request->id)->first();
            $students_accounts->update([
                'date' => date('Y-m-d'),
                'type' => 'payment',
                'student_id' => $request->student_id,
                'payment_id' => $payments->id,
                'debit' => $request->debit,
                'credit' => 0.00,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(__('messages.update'));
            return redirect()->route('payments.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->success(__('messages.error'));
            return redirect()->route('payments.index');
        }
    }

    public function destroy($id)
    {
        $payments = $this->payments->findorfail($id);
        $payments->student_account()->delete();
        $payments->fund_account()->delete();

        if ($payments->delete()) {
            return response()->json(['message' => __('messages.delete')]);
        }
        return response()->json(['message' => __('messages.unDelete')], 422);
    }
}
