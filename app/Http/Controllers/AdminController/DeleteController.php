<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB, Session;

class DeleteController extends Controller
{
    public function unactiveBranchCategory($id_category_branch)
    {
        if (Session::get('id_admin')) {
            DB::table('category_branch')->where('id_category_branch', $id_category_branch)->update(['status' => 0]);
            Session::put('message', 'Xóa branch thành công');
            return Redirect::to('/all-branch-category');
        } else {
            return redirect('login');
        }
    }

    public function activeBranchCategory($id_category_branch)
    {
        if (Session::get('id_admin')) {
            DB::table('category_branch')->where('id_category_branch', $id_category_branch)->update(['status' => 1]);
            Session::put('message', 'Active branch thành công');
            return Redirect::to('/all-branch-category');
        } else {
            return redirect('login');
        }
    }

    public function unactiveProduct($id_product)
    {
        if (Session::get('id_admin')) {
            DB::table('product')->where('id_product', $id_product)->update(['isActive' => 0]);
            Session::put('message', 'Xóa product thành công');
            return Redirect::to('/all-product');
        } else {
            return redirect('login');
        }
    }

    public function activeProduct($id_product)
    {
        if (Session::get('id_admin')) {
            DB::table('product')->where('id_product', $id_product)->update(['isActive' => 1]);
            Session::put('message', 'Active product thành công');
            return Redirect::to('/all-product');
        } else {
            return redirect('login');
        }
    }
}
