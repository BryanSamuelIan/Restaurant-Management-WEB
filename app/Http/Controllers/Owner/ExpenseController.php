<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense.create', [
            'pagetitle' => "Tambah Pengeluaran"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Expense::create($request->all());
        return redirect()->route('owner.purchases')->with('success', 'Expense added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expenseEdit = Expense::find($id);
        return view('expense.edit', ['expense' => $expenseEdit,
            'pagetitle' => "Edit Expense"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $expense = Expense::findOrFail($id);

    // Update expense attributes
    $expense->update($request->all());

    return redirect()->route('owner.purchases')->with('success', 'Expense updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Expense::find($id)->delete();
        return redirect()->route('owner.purchases');

    }
}
