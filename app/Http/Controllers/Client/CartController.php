<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart($productId)
    {
        $product = Product::find($productId);
        $cart = session()->get('cart') ?? [];
        $imagesLink = is_null($product->image) || !file_exists('images/' . $product->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg' : asset('images/' . $product->image);
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $imagesLink,
            'qty' => ($cart[$productId]['qty'] ?? 0) + 1
        ];
        session()->put('cart', $cart);

        $total_price = $this->calculateTotalPrice($cart);
        $total_items = count($cart);

        return response()->json(['message' => 'Thanh cong','total_price' => $total_price, 
        'total_items' => $total_items]);
        // dd($cart);
    }
    public function index()
    {
        $carts = session()->get('cart') ?? [];
        return view('client.pages.cart', ['carts' => $carts]);
    }

    public function calculateTotalPrice($cart): float{
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }
    public function deleteCart($productId)
    {
        $cart = session()->get('cart', []);
        if (array_key_exists($productId, $cart)) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        return response()->json(['message' => 'Thanh cong']);
    }
    public function updateCart($productId, $qty)
    {
        $cart = session()->get('cart', []);
        if(array_key_exists($productId, $cart)){
            $cart[$productId]['qty'] = $qty;
            if(!$qty){
                unset($cart[$productId]);
            }
            session()->put('cart', $cart);
        }
        $total_price = $this->calculateTotalPrice($cart);
        $total_items = count($cart);

        return response()->json([
            'message' => 'Update item success',
            'total_price' => $total_price, 
            'total_items' => $total_items
        ]);
    }
    public function deleteAll(){
        session()->put('cart', []);
        return response()->json([
            'message' => 'Delete all product success',
            'total_price' => 0, 
            'total_items' => 0
        ]);
    }
}
