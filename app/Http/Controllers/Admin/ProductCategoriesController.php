<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductCategoriesRequest;
use App\Http\Requests\UpdateProductCategoriesRequest;
use App\Models\ProductCategories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoriesController extends Controller
{
    public function index(Request $request)
    {
        //SEARCH
        $keyword = $request->keyword ?? '';
        $sortBy = $request->sortBy ?? 'latest';
        $status = $request->status ?? '';
        $sort = ($sortBy === 'oldest') ? 'asc' : 'desc';

        $filter = [];
        if (!empty($keyword)) {
            $filter[] = ['name', 'like', '%' . $keyword . '%'];
        }

        if ($status !== '') {
            $filter[] = ['status', $status];
        }

        $productCategories = ProductCategories::where($filter)
            ->orderBy('created_at', $sort)
            ->paginate(5);
        // dd($status);

        return view(
            'admin.pages.Product_Categories.list',
            [
                'productCategories' => $productCategories,
                'keyword' => $keyword,
                'sortBy' => $sortBy,
                'status' => $status
            ]
        );
    }
    public function add()
    {
        return view('admin.pages.Product_Categories.create');
    }
    public function store(CreateProductCategoriesRequest $request) //Request la dai dien cho khach hang gui len
    {
        //Eloquent

        $productCategory = new ProductCategories;
        $productCategory->name = $request->name;
        $productCategory->status = $request->status;
        $check = $productCategory->save();

        $message = $check ? 'thanh cong' : 'that bai';

        //session flash
        return redirect()->route('admin.product_categories.list')->with('message', $message);
    }
    public function detail($id)
    {
        //binding vo dau ? thay vi ghi thang vao de tranh bi tan cong
        // $productCategories = DB::select('SELECT * FROM product_categories where id = ?', [$id]);
        $productCategories = ProductCategories::find($id);
        // dd($productCategories);
        // return view('admin.pages.Product_Categories.detail', ['productCategories' => $productCategories[0]]);
        return view('admin.pages.Product_Categories.detail', ['productCategories' => $productCategories]);
    }
    public function update(UpdateProductCategoriesRequest $request, $id)
    {

        $productCategory = ProductCategories::find($id);
        $productCategory->name = $request->name;
        $productCategory->status = $request->status;
        $check = $productCategory->save();
        // $message = $check > 0 ? 'cap nhat thanh cong' : 'cap nhat that bai';
        $message = $check > 0 ? 'cap nhat thanh cong' : 'cap nhat that bai';
        return redirect()->route('admin.product_categories.list')->with('message', $message);
    }
    public function destroy($id)
    {
        // $check = DB::delete('DELETE FROM product_categories WHERE id = ? ', [$id]);
        $check = ProductCategories::find($id)->delete();
        $message = $check > 0 ? 'XOA thanh cong' : 'XOA that bai';
        return redirect()->route('admin.product_categories.list')->with('message', $message);
    }
}
