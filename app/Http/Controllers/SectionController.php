<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\SectionRepositoryInterface;
use App\Http\Requests\SectionsRequests;


class SectionController extends Controller
{
    protected $section;

    public function __construct(SectionRepositoryInterface $section)
    {
        $this->section = $section;
    }

    public function index()
    {
        return $this->section->index();
    }

    public function create()
    {
        return $this->section->create();
    }

    public function store(SectionsRequests $request)
    {
        return $this->section->store($request);
    }

    public function edit($id)
    {
        return $this->section->edit($id);
    }

    public function update(SectionsRequests $request, $id)
    {
        return $this->section->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->section->destroy($id);
    }

}
