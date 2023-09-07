<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductCategoriesRequest;
use App\Http\Requests\UpdateProductCategoriesRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoriesController extends Controller
{
    public function index(Request $request)
    {
        //SEARCH
        $keyword = $request->keyword;

        // $result = DB::select('select * from product_categories where name like ? order by created_at desc', ['%' . $keyword . '%']);

        // dd($result);

        //PAGINATION
        $itemPerPage = 2;
        // $page = $_GET["page"] ?? 1;
        $page = $request->page ?? 1;
        $offset = ($page - 1) * $itemPerPage;
        $productCategories = DB::select('select * from product_categories where name like ? order by created_at desc limit ?,?', [
            '%' . $keyword . '%',
            $offset,
            $itemPerPage
        ]);

        // $pagination = DB::select('select * from product_categories ');
        // $totalRecords = count($pagination);
        $totalRecords = DB::select('select count(*) as sum from product_categories ')[0]->sum;

        $totalPage = ceil($totalRecords / $itemPerPage);

        return view(
            'admin.pages.Product_Categories.list',
            [
                'productCategories' => $productCategories,
                'totalPage' => $totalPage,
                'currentPage' => $page,
                'keyword' => $keyword
            ]
        );
    }
    public function add()
    {
        return view('admin.pages.Product_Categories.create');
    }
    public function store(CreateProductCategoriesRequest $request) //Request la dai dien cho khach hang gui len
    {
        //dd($request->get('name'));//cach lay ra bien tu trong form cach 1
        //$name = $request->name;// cach lay ra bien tu trong form cach 2     
        //dd($request->all());// xem tat cac cac bien name co trong form
        $bool = DB::insert('INSERT INTO product_categories(name, created_at, updated_at, status) VALUES (?,?,?,?)', [
            $request->name,
            Carbon::now(),
            Carbon::now(),
            $request->status
        ]);
        // dd('thanh cong');
        // dd($request->all());
        $message = $bool ? 'thanh cong' : 'that bai';

        //session flash
        return redirect()->route('admin.product_categories.list')->with('message', $message);
    }
    public function detail($id)
    {
        //binding vo dau ? thay vi ghi thang vao de tranh bi tan cong
        $productCategories = DB::select('SELECT * FROM product_categories where id = ?', [$id]);
        // dd($productCategories);
        return view('admin.pages.Product_Categories.detail', ['productCategories' => $productCategories[0]]);
    }
    public function update(UpdateProductCategoriesRequest $request, $id)
    {

        $check = DB::update('UPDATE product_categories SET name= ?, status= ? WHERE id = ? ', [
            $request->name,
            $request->status,
            $id
        ]);
        $message = $check > 0 ? 'cap nhat thanh cong' : 'cap nhat that bai';
        return redirect()->route('admin.product_categories.list')->with('message', $message);
    }
    public function destroy($id)
    {
        $check = DB::delete('DELETE FROM product_categories WHERE id = ? ', [$id]);
        $message = $check > 0 ? 'XOA thanh cong' : 'XOA that bai';
        return redirect()->route('admin.product_categories.list')->with('message', $message);
    }
}
