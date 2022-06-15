<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
