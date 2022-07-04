<?php

namespace App\Http\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface GradeRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit(Model $model);

    public function update($request, $id);

    public function destroy($id);
}


