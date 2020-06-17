<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB, Session,Cart;
class HomeController extends Controller{
    public function index(){

//        $branch = DB::table('category_branch')->get();
//        foreach ($branch as $index) {
//            DB::table('category_branch')->where('id_category_branch',$index->id_category_branch)->update(['image' => $index->id_category_branch . '.jpg']);
//        }
        return view('users.home');
    }

    public function locate(Request $request){
        Session::put('idprovince',$request->id_province);
        return redirect()->back();
    }
}
