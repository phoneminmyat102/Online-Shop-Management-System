<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
class AdminController extends Controller
{
    public function index() {
        $user = Auth::user();
        return Inertia::render('Admin/Dashboard', ['user'=>$user]);
    }
}
