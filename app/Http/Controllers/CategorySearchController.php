<?php

namespace App\Http\Controllers;
use DB,Session;

use Illuminate\Http\Request;


class CategorySearchController extends Controller
{
    public function mainSearch(){

        $mainSearch = DB::table('category_main')->get();

        return view('users.category.category_main_list')->with('mainSearch',$mainSearch);
    }

    public function branchSearch($id_main){
        $branchSearch = DB::table('category_branch')->where('id_category_main', $id_main)->get();
        // get desription of category_main
        $idMain = $branchSearch[0]->id_category_main;
        $descriptionMain = DB::table('category_main')->select('name', 'description')->where('id_category_main', $idMain)->first();
        return view('users.category.category_branch_list')
            ->with('branchSearch',$branchSearch)
            ->with('descriptionMain', $descriptionMain);
    }

    public function productSearch($id_branch,Request $request){
        //select name, image, id_main, description
        $nameBranch = DB::table('category_branch')->select('name', 'image', 'id_category_main','descriptionf')->where('id_category_branch',$id_branch)->first();
        //trả về tên của branch có id = $id_branch

        $nameMain = DB::table('category_main')->select('name')->where('id_category_main', $nameBranch->id_category_main)->first();
        //trả về tên main cha của branch có id = $id_branch

        //Chỉ có $productSearch mới trả về mảng các object
        //tìm kiểm filter tại đây
//        echo $request->product_price;
//        echo $request->product_status;
//        echo $request->market_price;
//        echo $request->page;
//        echo $request->author;
//        echo $request->publisher;
        if($request->product_price != null && $request->product_status != null && $request->market_price != null && $request->page != null){
            $product_price = $request->product_price;
            $product_status = $request ->product_status ;
            $market_price = $request ->market_price;
            $page = $request ->page ;
            $author = $request ->author ;
            $publisher = $request ->publisher ;
            $productSearch = DB::table('product')
                ->where('id_category_branch', $id_branch)

                ->where('price','>=',$product_price * 0.5)
                ->where('price','<=',$product_price * 1.5)

                ->where('isactive',$product_status)

                ->where('market_price','>=',$market_price * 0.5)
                ->where('market_price','<=',$market_price * 1.5)

                ->where('page','>=',$page * 0.5)
                ->where('page','<=',$page * 1.5)

                ->where('author','like','%'.$author.'%')
                ->where('publisher', 'like','%'.$publisher.'%')

                ->get();
            $conHang = "Còn hàng"; $ngungKinhDoanh = "Ngừng kinh doanh";
            $filter = "Có ".count($productSearch)." Kết quả tìm kiếm cho: "."Giá: khoảng ".$request->product_price.', '.
            "Tình trạng: ".($request ->product_status == 1 ? $conHang : $ngungKinhDoanh).', '.
                "Giá thị trường: khoảng ".$request->market_price.', '.
                "Số trang: khoảng ".$request->page;
        }
        else {
            $productSearch = DB::table('product')->where('id_category_branch', $id_branch)->get();
            $filter = "";
        }  //trả về các sản phẩm thuộc branch có id = $id_branch
        //còn lại trả về 1 object

        $MainOnly = DB::table('category_main')->where('id_category_main', $nameBranch->id_category_main)->first(); //trả về main cha của branch có id = $id_branch
        // url get image of product
        $url = $nameMain->name . '/' . $nameBranch->name . '/';
        return view('users.category.product_list',['MainOnly'=>$MainOnly,'productSearch'=>$productSearch, 'url'=>$url,
            'nameBranch'=>$nameBranch,'idBranch'=>$id_branch,'filter'=>$filter]);
    }
}
