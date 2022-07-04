<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\StudentPromotionRepositoryInterface;
use App\Http\Requests\StudentPromotionRequests;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    protected $promotion;

    public function __construct(StudentPromotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;
    }

    public function index()
    {
        return $this->promotion->index();
    }

    public function create()
    {
        return $this->promotion->create();
    }

    public function store(StudentPromotionRequests $request)
    {
        return $this->promotion->store($request);
    }

    public function destroy(Request $request)
    {
        return $this->promotion->destroy($request);
    }
}
