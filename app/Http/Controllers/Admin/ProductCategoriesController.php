<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        $productCategories = DB::select('select * from product_categories');

        return view('admin.pages.Product_Categories.list',['productCategories'=>$productCategories]);
    }
    public function add()
    {
        return view('admin.pages.Product_Categories.create');
    }
    public function store(Request $request) //Request la dai dien cho khach hang gui len
    {
        //dd($request->get('name'));//cach lay ra bien tu trong form cach 1
        //$name = $request->name;// cach lay ra bien tu trong form cach 2     
        //dd($request->all());// xem tat cac cac bien name co trong form
        $request->validate([
            'name' => 'required|min:5|max:20|unique:product_categories,name',
            'status' => 'required',
        ],
        [
            'name.required' => 'Vui long dien ten !',
            'name.min' => 'Ten phai co tren 3 ky tu',
            'name.max' => 'Ten chi co toi da 20 ki tu',
            'status.required' => 'Vui long chon trang thai'
        ]);
        $bool = DB::insert('INSERT INTO product_categories(name, created_at, updated_at, status) VALUES (?,?,?,?)',[
            $request->name,
            Carbon::now(),
            Carbon::now(),
            $request->status
        ]);
        // dd('thanh cong');
        // dd($request->all());
        $message = $bool ? 'thanh cong' : 'that bai';

        //session flash
        return redirect()->route('admin.product_categories.list')->with('message',$message);
    }
    public function detail(){
        dd(1);
    }
}
