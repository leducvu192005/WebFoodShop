<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    // app/Http/Controllers/Admin/DashboardController.php



    public function index()
    {
        // Phân biệt view nếu muốn, nhưng đơn giản thì dùng chung view
        return view('admin.dashboard'); 
    }
}

