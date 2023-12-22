<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/transactions';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'name';
    }

    // public function login($request)
    // {
    //     $admin = [
    //         'username' => $request->name,
    //         'password' => $request->password,
    //         'role_id' => 2,
    //         'is_active'=>1
    //     ];


    //     $owner = [
    //         'username' => $request->name,
    //         'password' => $request->password,
    //         'role_id' => 3,
    //         'is_active'=>1

    //     ];
    //     if (Auth::attempt($admin)) {
    //         return redirect()->route('admin.transactions');
    //     }
    //     elseif (Auth::attempt($owner)) {
    //         return redirect()->route('owner.transactions');
    //     }



    // }

    protected function attemptLogin(Request $request)
    {
        return Auth::attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/login'); // Change this line
    }
}
