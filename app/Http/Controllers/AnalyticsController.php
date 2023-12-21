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
            ->where('status_id', 1)
            ->count();

        return $orderCount;
    }

    public function sumTotalTransactions()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $income = Transaction::where('status_id', 1)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total');

        return $income;
    }

    public function incomeComparison()
    {
        // Get the start and end dates for the current month
        $startOfCurrentMonth = Carbon::now()->startOfMonth();
        $endOfCurrentMonth = Carbon::now()->endOfMonth();

        // Get the start and end dates for the last month
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Calculate income for the current month
        $incomeCurrentMonth = Transaction::where('status_id', 1)
            ->whereBetween('created_at', [$startOfCurrentMonth, $endOfCurrentMonth])
            ->sum('total');

        // Calculate income for the last month
        $incomeLastMonth = Transaction::where('status_id', 1)
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('total');

        // Calculate the percentage difference
        $percentageDifference = 0;
        if ($incomeLastMonth != 0) {
            $percentageDifference = (($incomeCurrentMonth - $incomeLastMonth) / $incomeLastMonth) * 100;
        }

        return $percentageDifference;
    }

    public function index() {
        $transactionCount = $this->countTransactionToday();
        $income = $this->sumTotalTransactions();

        $incomeDifference = $this->incomeComparison();

        return view('analitics', [
            'transactionCount' => $transactionCount,
            'income' => $income,
            'incomeDifference' => $incomeDifference
        ]);
    }
}
