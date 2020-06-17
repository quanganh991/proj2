<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Session;
class ProductController extends Controller
{
    public function comment(Request $request)
    {
        $comment = $request->comment;
        $productid_hidden = $request->productid_hidden;
        $customerid_hidden = $request->customerid_hidden;
        DB::table('coment')
            ->insert(['id_product' => $productid_hidden, 'id_customer' => $customerid_hidden, 'content' => $comment, 'isvalid' => 1]);
        return back();
    }


    public function rating(Request $request){
        $point = $request->point;
        $productid_hidden = $request->productid_hidden;
        $rate = DB::table('product')->where('id_product',$productid_hidden)->get()->first();
        $ratequantity = DB::table('product')->where('id_product',$productid_hidden)->get()->first();

        $rate = $rate->rate;
        $ratequantity = $ratequantity->ratequantity;

        $rate = round(($rate*$ratequantity + 1.0 * $point)/($ratequantity + 1),2);
        $ratequantity = $ratequantity + 1;
        DB::table('product')
            ->where('id_product',$productid_hidden)
            ->update(['rate'=>$rate,'ratequantity'=>$ratequantity]);
        return back();
    }
}
