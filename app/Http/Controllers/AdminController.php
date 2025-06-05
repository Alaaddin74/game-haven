<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('admin.index', compact('produks'));
    }
}
