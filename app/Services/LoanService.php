<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Copy;
use App\Models\Loan;

class LoanService
{
    public function borrow(int $userId, int $copyId, ?string $dueAt = null)
    {
        $copy = Copy::findOrFail($copyId);
        if ($copy->status !== Copy::STATUS_AVAILABLE) throw new \Exception('Copy not available');
        $loan = Loan::create(['user_id' => $userId, 'copy_id' => $copyId, 'loaned_at' => now(), 'due_at' => $dueAt ? Carbon::parse($dueAt) : now()->addWeeks(2)]);
        $copy->update(['status' => Copy::STATUS_ON_LOAN]);
        return $loan;
    }
    public function return(int $loanId)
    {
        $loan = Loan::findOrFail($loanId);
        if ($loan->returned_at) throw new \Exception('Already returned');
        $loan->update(['returned_at' => now()]);
        $loan->copy->update(['status' => Copy::STATUS_AVAILABLE]);
        return $loan;
    }
    public function overdue()
    {
        return Loan::with(['user', 'copy'])->whereNull('returned_at')->where('due_at', '<', now())->get();
    }
}
