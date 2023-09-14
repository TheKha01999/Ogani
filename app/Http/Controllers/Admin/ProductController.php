<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products')->orderBy('created_at', 'desc')->paginate(3);
        return view('admin.pages.product.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = DB::select('select * from product_categories where status = 1');

        return view('admin.pages.product.create', ['productCategories' => $productCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request->file('image'));
        if ($request->hasFile('image')) {
            $fileOriginalName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $fileName .= '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $fileName);
        }

        $check = DB::table('products')->insert([
            "name" => $request->name,
            "slug" => $request->slug,
            "price" => $request->price,
            "discount_price" => $request->discount_price,
            "short_description" => $request->short_description,
            "qty" => $request->qty,
            "shipping" => $request->shipping,
            "weight" => $request->weight,
            "description" => $request->description,
            "information" => $request->information,
            "status" => $request->status,
            "product_categories_id" => $request->product_categories_id,
            "image" => $fileName ?? '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        $product = DB::table('products')->find($id);
        $productCategories = DB::table('product_categories')->where('status', '=', '1')->get();
        return view('admin.pages.product.detail', ['product' => $product, 'productCategories' => $productCategories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //show ra cac gia tri theo id
        // $check = DB::table('products')->where('id', '=', $id)->first();
        // $check = DB::table('products')->find($id);

        //xoa theo id
        // $check = DB::table('products')->where('id', '=', $id)->delete();

        $product = DB::table('products')->find($id);
        $image = $product->image;
        if (!is_null($image) && file_exists('images/' . $image)) {
            # code...
            unlink('images/' . $image);
        }

        $check = DB::table('products')->delete($id);
        $message = $check ? 'xoa thanh cong' : ' xoa that bai';

        return redirect()->route('admin.product.index')->with('message', $message);
    }
    public function createSlug(Request $request)
    {
        return response()->json(['slug' => Str::slug($request->name, '-')]);
    }
}
