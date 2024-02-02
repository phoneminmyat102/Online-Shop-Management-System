<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use inertia\inertia;
use App\Models\Product;
class UserController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'category', 'product_images')->orderBy('id', 'desc')->limit(8)->get();
        return inertia::render('User/Index', [
            'products' => $products,
            'canLogin' => app('router')->has('login'),
            'canRegister' => app('router')->has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }


}
