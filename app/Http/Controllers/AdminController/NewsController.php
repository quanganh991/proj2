<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB,Session,Cart;
class NewsController extends Controller
{
    public function displayAllNews(){
        if (Session::get('id_admin')) {
            $allNews = DB::table('news')
                ->get();
            return view('admin.news.displayAllNews')->with('allNews', $allNews);
        } else {
            return redirect('login');
        }
    }

    public function addNews(){
        if (Session::get('id_admin')) {
            return view('admin.news.addNews');
        } else {
            return redirect('login');
        }
    }

    public function saveNews(Request $request){
        if (Session::get('id_admin')) {
            $title = $request->title;
            $context = $request->context;
            $publish_date = date('Y-m-d H:i:s');
            $id_product = $request->id_product;
            $id_admin = Session::get('id_admin');
            $status = $request->status;

            DB::insert('insert into news (title, context, publish_date, id_product, id_admin, status) values (?, ?, ?, ?, ?,?)'
                , [$title, $context, $publish_date, $id_product, $id_admin,$status]);

            return back();
        } else {
            return redirect('login');
        }
    }

    public function activeNews($id_news){
        if (Session::get('id_admin')) {
            DB::table('news')->where('id_news', $id_news)->update(['status' => 1]);
            Session::put('message', 'Active news thành công');
            return Redirect::to('/display-all-news');
        } else {
            return redirect('login');
        }
    }

    public function unactiveNews($id_news){
        if (Session::get('id_admin')) {
            DB::table('news')->where('id_news', $id_news)->update(['status' => 0]);
            Session::put('message', 'Active news thành công');
            return Redirect::to('/display-all-news');
        } else {
            return redirect('login');
        }
    }

    public function editNews($id_news){
        if (Session::get('id_admin')) {//tìm id
            $edit_news = DB::table('news')->where('id_news', $id_news)->get()->first();
            //quăng sang trang edit
            return view('admin.news.editNews')->with('edit_news', $edit_news);
        } else {
            return redirect('login');
        }
    }

    public function submitEditNews(Request $request){
        if (Session::get('id_admin')) {
            $id_news = $request->id_news;
            $title = $request->title;
            $context = $request->context;
            $publish_date = date('Y-m-d H:i:s');
            $id_product = $request->id_product;
            $id_admin = Session::get('id_admin');
            $status = $request->status;
            DB::table('news')->where('id_news', $id_news)
                ->update(['title' => $title, 'context' => $context, 'publish_date' => $publish_date, 'id_product' => $id_product, 'id_admin' => $id_admin,'status'=>$status]);

            return Redirect::to('/display-all-news');
        } else {
            return redirect('login');
        }
    }
}
