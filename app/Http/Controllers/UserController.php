<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role_id', [1, 2])->get();

        return view('user.index', ['users' => $users]);
    }

    public function updateActiveStatus($userId)
    {
        $user = User::findOrFail($userId);
        $user->update(['is_active' => request('is_active')]);

        // You can return a response if needed
        return response()->json(['status' => 'success']);
    }

    public function create() {
        $employees = Employee::all();
        $roles = Role::all();

        return view('user.create', ['employees' => $employees, 'roles' => $roles]);
    }

    public function store(Request $request) {
        User::create([
            'name' => $request->name,
            'employee_id' => $request->employee_id,
            'role_id' => $request->role_id,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('users');
    }
}
