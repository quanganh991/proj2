<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Session;

class AddController extends Controller
{
    public function addBranchCategory()
    {
        if (Session::get('id_admin')) {
            return view('admin.add.add_branch_category');
        } else {
            return redirect('login');
        }
    }

    public function saveBranchCategory(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_category_main = $request->id_category_main;
            $branch_name = $request->branch_name;
            $branch_descr = $request->branch_descr;
            $branch_logo = $request->branch_logo;
            $branch_status = $request->branch_status;

            DB::insert('insert into category_branch (id_category_main, name, descriptionf, image, status) values (?, ?, ?, ?, ?)'
                , [$id_category_main, $branch_name, $branch_descr, $branch_logo, $branch_status]);

            return back();
        } else {
            return redirect('login');
        }
    }

    public function addMainCategory()
    {
        if (Session::get('id_admin')) {
            return view('admin.add.add_main_category');
        } else {
            return redirect('login');
        }
    }

    public function saveMainCategory(Request $request)
    {
        if (Session::get('id_admin')) {
            $main_name = $request->main_name;
            $main_descr = $request->main_descr;

            DB::insert('insert into category_main (name, description) values (?, ?)'
                , [$main_name, $main_descr]);

            return back();
        } else {
            return redirect('login');
        }
    }

    public function addProduct()
    {
        if (Session::get('id_admin') || Session::get('id_lease')) {
            return view('admin.add.add_product');
        } else {
            return redirect('login');
        }
    }

    public function saveProduct(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_category_branch = $request->id_category_branch;
            $product_name = $request->product_name;
            $product_descr = $request->product_descr;
            $product_image = $request->product_image;
            $product_amount = $request->product_amount;
            $product_price = $request->product_price;
            $product_status = $request->product_status;
            $market_price = $request->market_price;
            $page = $request->page;
            $sku = $request->sku;
            $author = $request->author;
            $publisher = $request->publisher;

            DB::insert('insert into product (id_category_branch,name,description,image,amount,price,isActive,rate,ratequantity,
                market_price,page,sku,turnover,author,publisher) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
                , [$id_category_branch, $product_name, $product_descr, $product_image, $product_amount, $product_price, $product_status, 0, 0,
                    $market_price,$page,$sku,0,$author,$publisher]);
            return back();
        } else {
            return redirect('login');
        }
    }
}
