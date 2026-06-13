<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function partial()
    {
        $user = Auth::user();
        $loginTime = session('login_time', 'Belum ada data');
        
        return view('partials.dashboard', compact('user', 'loginTime'));
    }
}
