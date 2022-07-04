<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\FeesRepositoryInterface;
use App\Http\Requests\FeeRequest;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    protected $fees;

    public function __construct(FeesRepositoryInterface $fees)
    {
        $this->fees = $fees;
    }

    public function index()
    {
        return $this->fees->index();
    }

    public function create()
    {
        return $this->fees->create();
    }

    public function store(FeeRequest $request)
    {
        return $this->fees->store($request);
    }

    public function edit($id)
    {
        return $this->fees->edit($id);
    }

    public function update(FeeRequest $request, $id)
    {
        return $this->fees->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->fees->destroy($id);
    }
}
