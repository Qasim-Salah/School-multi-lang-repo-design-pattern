<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProcessingFeeRepositoryInterface;
use App\Http\Requests\ProcessingFeeRequest;
use Illuminate\Http\Request;

class ProcessingFeeController extends Controller
{
    protected $processing;

    public function __construct(ProcessingFeeRepositoryInterface $processing)
    {
        $this->processing = $processing;
    }

    public function index()
    {
        return $this->processing->index();
    }

    public function create($id)
    {
        return $this->processing->create($id);
    }

    public function store(ProcessingFeeRequest $request)
    {
        return $this->processing->store($request);
    }

    public function edit($id)
    {
        return $this->processing->edit($id);
    }

    public function update(ProcessingFeeRequest $request, $id)
    {
        return $this->processing->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->processing->destroy($id);
    }
}
