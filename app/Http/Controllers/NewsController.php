<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Session,Cart;
class NewsController extends Controller //tin tức dành cho user
{
    public function listNewsForUser(){
        $listNews = DB::table('news')
            ->orderBy('id_news','DESC')
            ->get();
        return view('users.news.listNewsForUser')->with('listNews',$listNews);

    }

    public function detailNewsForUser($id_news){
        $detailNews = DB::table('news')
            ->join('admininfo','news.id_admin','=','admininfo.id_admin')
            ->where('news.id_news',$id_news)
            ->get()->first();
        return view('users.news.detailNewsForUser')->with('detailNews',$detailNews);
    }
}
