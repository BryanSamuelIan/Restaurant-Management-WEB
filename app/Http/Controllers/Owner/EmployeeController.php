<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        return view('employee.index', ['employees' => $employees,
        'pagetitle' => "Karyawan"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create', [
        'pagetitle' => "Buat Karyawan"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ktp !=null) {
            $ktpPath = $request->file('ktp')->store('ktp_images', 'public');
            Employee::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'sallary' => $request->sallary,
                'ktp' => $ktpPath
            ]);
        } else {
            Employee::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'sallary' => $request->sallary
            ]);

        }

        return redirect()->route('employees');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
