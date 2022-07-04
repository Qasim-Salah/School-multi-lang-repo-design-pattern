<?php

namespace App\Http\Controllers;


use App\Http\Interfaces\FeesInvoicesRepositoryInterface;
use App\Http\Requests\FeeInvoicesRequest;
use Illuminate\Http\Request;

class FeeInvoicesController extends Controller
{
    protected $fees_invoices;

    public function __construct(FeesInvoicesRepositoryInterface $fees_invoices)
    {
        $this->fees_invoices = $fees_invoices;
    }

    public function index()
    {
        return $this->fees_invoices->index();
    }

    public function create($id)
    {
        return $this->fees_invoices->create($id);
    }

    public function store(FeeInvoicesRequest $request)
    {
        return $this->fees_invoices->store($request);
    }

    public function edit($id)
    {
        return $this->fees_invoices->edit($id);
    }

    public function update(FeeInvoicesRequest $request, $id)
    {
        return $this->fees_invoices->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->fees_invoices->destroy($id);
    }
}
