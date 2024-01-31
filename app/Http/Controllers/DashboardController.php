<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Products;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all()->count();
        $kasir = User::where('role', 'petugas')->count();
        $products = Products::all()->count();
        $sales = Sale::all()->count();
        return view('dashboard', compact('users', 'products', 'sales', 'kasir'));
    }
}
