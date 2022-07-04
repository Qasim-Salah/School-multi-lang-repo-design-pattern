<?php

namespace App\Http\Controllers;


use App\Http\Interfaces\ReceiptStudentsRepositoryInterface;
use App\Http\Requests\ReceiptRequest;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{
    protected $receipt;

    public function __construct(ReceiptStudentsRepositoryInterface $receipt)
    {
        $this->receipt = $receipt;
    }

    public function index()
    {
        return $this->receipt->index();
    }

    public function create($id)
    {
        return $this->receipt->create($id);
    }

    public function store(ReceiptRequest $request)
    {
        return $this->receipt->store($request);
    }

    public function edit($id)
    {
        return $this->receipt->edit($id);
    }

    public function update(ReceiptRequest $request, $id)
    {
        return $this->receipt->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->receipt->destroy($id);
    }
}
