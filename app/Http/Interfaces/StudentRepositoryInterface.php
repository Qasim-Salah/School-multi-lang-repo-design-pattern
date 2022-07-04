<?php

namespace App\Http\Interfaces;

interface StudentRepositoryInterface
{

    public function index();

    public function edit($id);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function create();

    public function store($request);

    public function upload_attachment($request);

    public function download_attachment($id);

    public function destroy_attachment($id);

}


