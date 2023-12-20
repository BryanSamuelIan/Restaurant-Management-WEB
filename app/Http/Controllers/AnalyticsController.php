<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function countTransactionToday()
    {
        $today = Carbon::now()->toDateString();

        $orderCount = Transaction::whereDate('created_at', $today)
            ->where('status_id', 5)
            ->count();

        return $orderCount;
    }

    public function sumTotalTransactions()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $income = Transaction::where('status_id', 5)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total');

        return $income;
    }

    public function index() {
        $transactionCount = $this->countTransactionToday();
        $income = $this->sumTotalTransactions();

        return view('analitics', [
            'transactionCount' => $transactionCount,
            'income' => $income
        ]);
    }
}
