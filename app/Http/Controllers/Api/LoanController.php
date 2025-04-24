<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\LoanService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Loan\BorrowLoanRequest;
use Symfony\Component\HttpFoundation\Response;

class LoanController extends Controller
{
    protected LoanService $service;
    public function __construct(LoanService $service)
    {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }
    public function borrow(BorrowLoanRequest $reruest)
    {
        $loan = $this->service->borrow($reruest->user_id, $reruest->copy_id, $reruest->due_at);
        return response()->json($loan, Response::HTTP_CREATED);
    }
    public function return($loan)
    {
        $returnedLoan = $this->service->return($loan);
        return response()->json($returnedLoan);
    }
    public function overdue()
    {
        return response()->json($this->service->overdue());
    }
}
