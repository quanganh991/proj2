<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Cart;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $quantity = $request->quantity;
        $productid_hidden = $request->productid_hidden;

        $info = DB::table('product')->where('id_product', $productid_hidden)->get()->first();

        //id, name, quantity, price and weight
        $data['id'] = $info->id_product;
        $data['qty'] = $quantity;
        $data['name'] = $info->name;
        $data['price'] = $info->price;
        $data['weight'] = $info->price;
        $data['option']['image'] = $info->image;

        Cart::add($data);   //hàm add này hoạt động ntn thì do system quản lý
        return Redirect::to('/show-cart');
    }

    public function showCart()
    {
        return view('users.cart.cart');
    }

    public function updateCartQuantity(Request $request)
    {
        $quantity = $request->quantity;
        $id = $request->id;
        Cart::update($id, $quantity);
        return Redirect::to('/show-cart');
    }

    public function deleteFromCart($rowID)
    {
        Cart::update($rowID, 0);
        return Redirect::to('/show-cart');
    }

    public function destroyCart(){
        Cart::destroy();
        return Redirect::to('/show-cart');
    }
}
