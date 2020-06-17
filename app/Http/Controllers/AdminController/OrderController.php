<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use http\Exception;
use Illuminate\Http\Request;
use DB, Session, Cart;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function viewOrder()
    {
        if (Session::get('id_admin')) {
            $allOrder = DB::table('oder')
                ->orderBy('date','DESC')
                ->get();
            return view('admin.orderManagement.view_order')->with('allOrder', $allOrder);
        } else {
            return redirect('login');
        }
    }

    public function approveOrder($id_oder)
    { //duyệt
        if (Session::get('id_admin')) {
            DB::table('oder')
                ->where('id_oder', $id_oder)
                ->update(['isapproved' => 1]);
            DB::table('notification')
                ->insert(['id_oder' => $id_oder, 'isread' => 0, 'datenoti' => date('Y-m-d H:i:s'),
                    'context' => "Xin chúc mừng, đơn hàng " . $id_oder . " đã được duyệt thành công, BookShop đang giao hàng cho bạn!"]);
            $tb = Session::get('notification') + 1;
            Session::remove('notification');
            Session::put('notification', $tb);
            return back();

        } else {
            return redirect('login');
        }
    }

    public function unApproveOrder($id_oder)
    { //hủy
        if (Session::get('id_admin')) {
            DB::table('oder')
                ->where('id_oder', $id_oder)
                ->update(['isapproved' => 3]);
            DB::table('notification')
                ->insert(['id_oder' => $id_oder, 'isread' => 0, 'datenoti' => date('Y-m-d H:i:s'),
                    'context' => "Rất tiếc, đơn hàng " . $id_oder . " đã bị hủy, quý khách vui lòng liên hệ BookShop để biết thêm chi tiết. Mong
                    quý khách thông cảm vì sự bất tiện này"]);
            $tb = Session::get('notification') + 1;
            Session::remove('notification');
            Session::put('notification', $tb);
            return back();
        } else {
            return redirect('login');
        }
    }

    public function succeedOrder($id_oder)
    { //đánh dấu giao thành công
        if (Session::get('id_admin')) {
            DB::table('oder')
                ->where('id_oder', $id_oder)
                ->update(['isapproved' => 2]);
            DB::table('notification')
                ->insert(['id_oder' => $id_oder, 'isread' => 0, 'datenoti' => date('Y-m-d H:i:s'),
                    'context' => "Đơn hàng " . $id_oder . " đã được giao thành công, chân thành cảm ơn quý khách đã sử dụng dịch vụ của BookShop"]);
            $tb = Session::get('notification') + 1;
            Session::remove('notification');
            Session::put('notification', $tb);

            return back();
        } else {
            return redirect('login');
        }
    }

    public function viewOrderDetail($id_oder)
    {
        if (Session::get('id_admin')) {
            $allOrderDetail = DB::table('oder_detail')
                ->where('id_oder', $id_oder)
                ->get();
            $DONHANG = DB::table('oder')->where('id_oder', $id_oder)->get()->first();
            $KH = DB::table('customer')->where('id_customer', $DONHANG->id_customer)->get()->first();
            return view('admin.orderManagement.view_order_detail')->with('allOrderDetail', $allOrderDetail)->with('KH', $KH->name)
                ->with('DONHANG', $DONHANG);
        } else {
            return redirect('login');
        }
    }

    public function editOrderDetail($id_oder_detail)
    {
        if (Session::get('id_admin')) {
            $oder_detail = DB::table('oder_detail')
                ->where('id_oder_detail', $id_oder_detail)
                ->get()->first();
            return view('admin.orderManagement.edit_order_detail')->with('oder_detail', $oder_detail);
        } else {
            return redirect('login');
        }
    }

    public function submitEditOrderDetail(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_oder_detail = $request->id_oder_detail;
            $item_order = $request->item_order;
            $id_oder = $request->id_oder;
            $id_product = $request->id_product;
            $quantity = $request->quantity;
            $subprice = $request->subprice;
            $id_partner_delivery = $request->id_partner_delivery;
            $VAT = $request->VAT;

            DB::table('oder_detail')
                ->where('id_oder_detail', $id_oder_detail)
                ->update(['item_order' => $item_order, 'id_oder' => $id_oder, 'id_product' => $id_product, 'quantity' => $quantity, 'subprice' => $subprice,
                    'id_partner_delivery' => $id_partner_delivery, 'VAT' => $VAT]);
            return Redirect::to('/view-order-detail/' . $id_oder);
        } else {
            return redirect('login');
        }
    }
}
