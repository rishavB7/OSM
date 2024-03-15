<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        if(Auth::user()->role == 1){
            return view('Master_Admin.dashboard');
    
        }elseif(Auth::user()->role == 2){
            return view('District_Admin.dashboard');
        }else{
    
            return view('HOD_Admin.dashboard');
        }
    }
}
