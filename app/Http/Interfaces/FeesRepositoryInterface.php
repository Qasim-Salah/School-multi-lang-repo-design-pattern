<?php

namespace App\Http\Interfaces;

interface FeesRepositoryInterface
{
    public function index();

    public function create();

    public function edit($id);

    public function store($request);

    public function update($request, $id);

    public function destroy($id);
}


