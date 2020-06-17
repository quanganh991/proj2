<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session, DB, Cart;

class OrderController extends Controller
{
    public function viewUserOrderDetail($id_oder)
    {  //xem chi tiết từng sản phẩm trong đơn hàng
        if (Session::get('id_customer')) {
            $allUserOrderDetail = DB::table('oder_detail')
                ->where('id_oder', $id_oder)
                ->get();
                return view('users.order.userOrderDetail')->with('allUserOrderDetail', $allUserOrderDetail)
                    ->with('countAllUserOrderDetail',count($allUserOrderDetail))
                    ->with('idDonHang',$id_oder);
        } else {
            return redirect('login');
        }
    }

    public function viewUserOrder()
    {    //xem các đơn hàng của người dùng
        if (Session::get('id_customer')) {
            $allUserOrder = DB::table('oder')
                ->where('id_customer', Session::get('id_customer'))
                ->get();
            if (count($allUserOrder) > 0) {
                return view('users.order.userOrder')->with('allUserOrder', $allUserOrder);
            } else {
                return view('users.order.notBuyYet');
            }
        } else {
            return redirect('login');
        }
    }

    public function cancelUserOrder($id_oder)
    {
        if (Session::get('id_customer')) {
            $allUserOrder = DB::table('oder')
                ->where('id_oder', $id_oder)
                ->update(['isapproved' => 3]);
            DB::table('notification')
                ->insert(['id_oder'=>$id_oder,'isread'=>0,'datenoti'=>date('Y-m-d H:i:s'),
                    'context'=>"Đơn hàng ".$id_oder." đã được hủy thành công, BookShop rất tiếc vì sự bất tiện này, quý khách có thể đặt mua những
                    sản phẩm khác trên BookShop. Cảm ơn quý khách đã sử dụng dịch vụ của BookShop"]);
            $tb = Session::get('notification') + 1;
            Session::remove('notification');
            Session::put('notification',$tb);
            return back();
        } else {
            return redirect('login');
        }
    }
}
