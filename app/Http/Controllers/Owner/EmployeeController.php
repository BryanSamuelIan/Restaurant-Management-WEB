<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Requests;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        return view('employee.index', [
            'employees' => $employees,
            'pagetitle' => "Karyawan"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create', [
            'pagetitle' => "Buat Karyawan"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ktp != null) {
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

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $pagetitle = "Edit Karyawan";
        return view('employee.edit', compact('employee', 'pagetitle'));
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // Delete the associated KTP image if it exists
        if ($employee->ktp) {
            Storage::disk('public')->delete($employee->ktp);
        }

        $employee->delete();

        return redirect()->route('employees')->with('success', 'Employee deleted successfully.');
    }
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        // Update employee information
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->sallary = $request->sallary;

        // Check if a new KTP image is provided
        if ($request->hasFile('newKtp')) {
            // Delete the current KTP image from storage if it exists
            if ($employee->ktp) {
                Storage::disk('public')->delete($employee->ktp);
            }

            // Store the new KTP image and update the path
            $newKtpPath = $request->file('newKtp')->store('ktp_images', 'public');
            $employee->ktp = $newKtpPath;
        }

        // Save the changes to the employee
        $employee->save();

        return redirect()->route('employees')->with('success', 'Employee updated successfully');
    }
}
