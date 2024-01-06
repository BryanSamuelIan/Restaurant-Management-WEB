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
            $imagePath = $request->file('ktp');
            $imageName = time() . '.' . $imagePath->extension();
            $imagePath->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;

            Employee::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'sallary' => $request->sallary,
                'ktp' => $imagePath
            ]);
        } else {
            Employee::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'sallary' => $request->sallary
            ]);
        }

        return redirect()->route('owner.employees');
    }





    public function updateActiveStatus($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->is_active = !$employee->is_active;
            $employee->save();

            // Deactivate linked user if employee is inactive
            if (!$employee->is_active) {
                $user = $employee->user; // Retrieve linked user
                if ($user) {
                    $user->is_active = false;
                    $user->save();
                }
            }

            return response()->json(['is_active' => $employee->is_active]);
        }

        return response()->json(['error' => 'Employee not found'], 404);
    }



    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $pagetitle = "Edit Karyawan";
        return view('employee.edit', compact('employee', 'pagetitle'));
    }

    public function destroy($id)
    {
        $old = Employee::find($id);

        if ($old->ktp) {
            $oldBannerPath = public_path($old->ktp);

            if (file_exists($oldBannerPath)) {
                unlink($oldBannerPath);
            }
        }
        Employee::find($id)->delete();

        return redirect()->route('owner.employees')->with('success', 'Employee deleted successfully.');
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

                $oldBannerPath = public_path($employee->ktp);

                if (file_exists($oldBannerPath)) {
                    unlink($oldBannerPath);
                }



            $bannerPath = $request->file('newKtp');
            $bannerName = time() . '.' . $bannerPath->extension();
            $bannerPath->move(public_path('images'), $bannerName);
            $bannerPath = 'images/' . $bannerName;
            $employee->ktp=$bannerPath;
        }

        // Save the changes to the employee
        $employee->save();

        return redirect()->route('owner.employees')->with('success', 'Employee updated successfully');
    }
}
