<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function countTransactionToday()
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        $orderCount = Transaction::whereDate('transaction_time', $today)
            ->where('status_id', 2)
            ->count();

        return $orderCount;
    }

    public function transactionsDifferenceTodayYesterday()
    {
        // Get today's and yesterday's date
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $yesterday = Carbon::yesterday('Asia/Jakarta')->toDateString();

        // Query transactions for today and yesterday
        $transactionsToday = Transaction::whereDate('transaction_time', $today)->where('status_id', 2)->count();
        $transactionsYesterday = Transaction::whereDate('transaction_time', $yesterday)->where('status_id', 2)->count();

        // Calculate the difference
        $difference = $transactionsToday - $transactionsYesterday;

        return $difference;
    }
    
    public function incomeDifferenceTodayYesterday()
    {
        // Get the date for today and yesterday
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $yesterday = Carbon::yesterday('Asia/Jakarta')->toDateString();

        // Calculate income for today
        $incomeToday = Transaction::where('status_id', 2)
            ->whereDate('transaction_time', $today)
            ->sum('total');

        // Calculate income for yesterday
        $incomeYesterday = Transaction::where('status_id', 2)
            ->whereDate('transaction_time', $yesterday)
            ->sum('total');

        // Calculate the percentage difference
        $percentageDifference = 0;
        if ($incomeYesterday != 0) {
            $percentageDifference = (($incomeToday - $incomeYesterday) / $incomeYesterday) * 100;
        }

        return $percentageDifference;
    }

    public function sumTotalTransactions()
    {
        $startOfMonth = Carbon::now('Asia/Jakarta')->startOfMonth();
        $endOfMonth = Carbon::now('Asia/Jakarta')->endOfMonth();

        $income = Transaction::where('status_id', 2)
            ->whereBetween('transaction_time', [$startOfMonth, $endOfMonth])
            ->sum('total');

        return $income;
    }

    public function incomeToday()
    {
        $currentDate = Carbon::now('Asia/Jakarta')->toDateString();

        $incomePerDay = Transaction::where('status_id', 2)
            ->whereDate('transaction_time', $currentDate)
            ->sum('total');

        return $incomePerDay;
    }

    public function incomeComparison()
    {
        // Get the start and end dates for the current month
        $startOfCurrentMonth = Carbon::now('Asia/Jakarta')->startOfMonth();
        $endOfCurrentMonth = Carbon::now('Asia/Jakarta')->endOfMonth();

        // Get the start and end dates for the last month
        $startOfLastMonth = Carbon::now('Asia/Jakarta')->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now('Asia/Jakarta')->subMonth()->endOfMonth();

        // Calculate income for the current month
        $incomeCurrentMonth = Transaction::where('status_id', 2)
            ->whereBetween('transaction_time', [$startOfCurrentMonth, $endOfCurrentMonth])
            ->sum('total');

        // Calculate income for the last month
        $incomeLastMonth = Transaction::where('status_id', 2)
            ->whereBetween('transaction_time', [$startOfLastMonth, $endOfLastMonth])
            ->sum('total');

            if ($incomeLastMonth == 0) {
                return $incomeCurrentMonth;
            }

        // Calculate the percentage difference
        $percentageDifference = 0;
        if ($incomeLastMonth != 0) {
            $percentageDifference = (($incomeCurrentMonth - $incomeLastMonth) / $incomeLastMonth) * 100;
        }

        return $percentageDifference;
   }

    public function index() {
        $transactions = Transaction::all();
        $transactionCount = $this->countTransactionToday();
        $income = $this->sumTotalTransactions();

        $incomeDifference = $this->incomeComparison();

        $incomeToday = $this->incomeToday();

        $differenceYesterday = $this->incomeDifferenceTodayYesterday();

        $transactionsYesterday = $this->transactionsDifferenceTodayYesterday();

        return view('analitics', [
            'transactionCount' => $transactionCount,
            'income' => $income,
            'incomeDifference' => $incomeDifference,
            'incomeToday' => $incomeToday,
            'difference' => $differenceYesterday,
            'transactionsDifference' => $transactionsYesterday,
            'pagetitle' => "Analytics",
            'transactions' => $transactions
        ]);
    }
}
