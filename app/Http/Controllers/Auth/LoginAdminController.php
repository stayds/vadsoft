<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('adminLogout');
        $this->middleware(['admin','backinvalidate'])->only('adminLogout');
    }

    public function showAdminLoginForm()
    {
        return view('admin.partial.login');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('adminweb')->attempt(
            ['email' => $request->email,
                'password' => $request->password, 'status'=>1], $request->get('remember'))) {
            // dd('authenticated');
            return redirect()->intended(route('get.admin.dashboard'));
        }

        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['approve' => 'Check login details entered, validation failed.']);
    }

    public function adminLogout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(route('get.admin.login'));
    }

    protected function guard()
    {
        return Auth::guard('adminweb');
    }

}
