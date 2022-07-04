<?php

namespace App\Http\Interfaces;

interface StudentGraduatedRepositoryInterface
{

    public function index();

    public function create();

    public function SoftDelete($request);

    public function update($request);

    public function destroy($request);
}


