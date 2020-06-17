<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session, DB, Cart;
class StatisticController extends Controller
{
    public function accessQuantity()
    {
        if (Session::get('id_admin')) {
            $accessQty = DB::table('statistic')->get();
            $totalRow = $accessQty->count();
            return view('admin.statistic.accessQuantity')->with('accessQty',$accessQty)->with('totalRow',$totalRow);
        } else {
            return redirect('login');
        }
    }

    public function revenue()
    {
        if (Session::get('id_admin')) {
            $revenue = DB::table('statistic')->get();
            $totalRow = $revenue->count();
            return view('admin.statistic.revenue')->with('revenue',$revenue)->with('totalRow',$totalRow);
        } else {
            return redirect('login');
        }
    }
}
