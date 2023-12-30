<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', [
            'users' => $users,
            'pagetitle' => "User"
        ]);
    }

    public function create()
{
    $employeesWithoutUsers = Employee::whereDoesntHave('user')->get();
    $roles = Role::all();

    return view('user.create', [
        'employees' => $employeesWithoutUsers,
        'roles' => $roles,
        'pagetitle' => "Buat User"
    ]);
}

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'employee_id' => $request->employee_id,
            'role_id' => $request->role_id,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('owner.users');
    }

    public function updateActiveStatus($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->is_active = !$user->is_active;
            $user->save();

            return response()->json(['is_active' => $user->is_active]);
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    public function updatePassword(Request $request, $id)
    {

        $user = User::findOrFail($id);

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json(['message' => 'Password updated successfully'], 200);
    }
    public function destroy(string $id)
    {
        $old = User::find($id);


        User::find($id)->delete();
        return redirect()->route('owner.users');

    }
}
