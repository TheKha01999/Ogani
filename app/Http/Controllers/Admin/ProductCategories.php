<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategories extends Controller
{
    public function index()
    {
        return view('admin.pages.Product_Categories.list');
    }
    public function add()
    {
        return view('admin.pages.Product_Categories.create');
    }
    public function store()
    {
        dd(1);
    }
}
