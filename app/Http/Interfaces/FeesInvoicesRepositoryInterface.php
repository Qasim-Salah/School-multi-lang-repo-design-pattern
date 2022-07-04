<?php

namespace App\Http\Interfaces;

interface FeesInvoicesRepositoryInterface
{
    public function index();

    public function create($id);

    public function edit($id);

    public function store($request);

    public function update($request, $id);

    public function destroy($id);
}


