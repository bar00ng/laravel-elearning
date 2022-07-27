<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index() {    
        if(Auth::user()->hasRole('mahasiswa')){
            return view('mahasiswa.dashboard');
        }elseif(Auth::user()->hasRole('dosen')){
            return view('dosen.dashboard');
        }elseif(Auth::user()->hasRole('admin')){
            return view('admin.dashboard');
        }
    }
}
