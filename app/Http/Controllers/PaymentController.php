<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\PaymentRepositoryInterface;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $payment;

    public function __construct(PaymentRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }

    public function index()
    {
        return $this->payment->index();
    }

    public function create($id)
    {
        return $this->payment->create($id);
    }

    public function store(PaymentRequest $request)
    {
        return $this->payment->store($request);
    }

    public function edit($id)
    {
        return $this->payment->edit($id);
    }

    public function update(PaymentRequest $request, $id)
    {
        return $this->payment->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->payment->destroy($id);
    }
}
