<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalProducts'   => Product::count(),
            'totalCategories' => Category::count(),
            'totalBanners'    => Banner::count(),
            'totalAdmins'     => User::count(),
        ]);
    }
}