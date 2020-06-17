<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        return view('users.product.search');
    }

    public function searchResult(Request $request)
    {
        $keyword = $request->keyword;
        $category_main = DB::table('category_main')->where('name', 'like', '%' . $keyword . '%')->get();
        $category_branch = DB::table('category_branch')->where('name', 'like', '%' . $keyword . '%')->get();
        $product = DB::table('product')->where('name', 'like', '%' . $keyword . '%')->get();

        return view('users.product.searchResult')->with('category_main', $category_main)->with('category_branch', $category_branch)->with('product', $product);
    }

    public function showDetail($id_product)
    {
        $query = DB::table('category_main')
            ->join('category_branch', 'category_main.id_category_main', '=', 'category_branch.id_category_main')
            ->join('product', 'product.id_category_branch', '=', 'category_branch.id_category_branch')
            ->where('product.id_product', $id_product)
            ->get(); //chỉ trả về 1 kết quả duy nhất...
        $query = $query->first();

        $categoryMainOnly = DB::table('category_main')
            ->where('id_category_main', $query->id_category_main);

        $categoryBranchOnly = DB::table('category_branch')
            ->where('id_category_branch', $query->id_category_branch);

        $categoryMainOnly = $categoryMainOnly->first(); //trả về main cha của branch
        $categoryBranchOnly = $categoryBranchOnly->first(); //trả về branch cha của product


        return view('users.product.productDetail')
            ->with('categoryMainOnly', $categoryMainOnly) //kiểu dữ liệu là 1 bản ghi
            ->with('categoryBranchOnly', $categoryBranchOnly)
            ->with('queryy', $query); //kiểu dữ liệu là nhiều bản ghi
    }
}
