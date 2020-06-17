<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session,DB,Cart;

class PartnerController extends Controller
{
    public function showAllPartnerDelivery()       //hiển thị tất cả danh mục đối tác giao hàng
    {
        if (Session::get('id_admin')) {
            $allPartnerDelivery = DB::table('partner_delivery')
                ->get();
            return view('admin.partner_delivery.all_partner_delivery')->with('allPartnerDelivery', $allPartnerDelivery);
        } else {
            return redirect('login');
        }
    }

    public function savePartnerDelivery(Request $request)
    {
        if (Session::get('id_admin')) {
            $name = $request->name;
            $shipping_fee = $request->shipping_fee;
            $return_fee = $request->return_fee;

            DB::insert('insert into partner_delivery (name, shipping_fee, return_fee) values (?, ?, ?)'
                , [$name, $shipping_fee, $return_fee]);

            return back();
        } else {
            return redirect('login');
        }
    }

    public function editPartnerDelivery($id_partner_delivery){
        if (Session::get('id_admin')) {//tìm id
            $edit_partner_delivery = DB::table('partner_delivery')->where('id_partner_delivery', $id_partner_delivery)->get()->first();
            //quăng sang trang edit
            return view('admin.partner_delivery.edit_partner_delivery')->with('edit_partner_delivery', $edit_partner_delivery);
        } else {
            return redirect('login');
        }
    }

    public function submitPartnerDelivery(Request $request)
    {
        if (Session::get('id_admin')) {
            $id_partner_delivery = $request->id_partner_delivery;
            $name = $request->name;
            $shipping_fee = $request->shipping_fee;
            $return_fee = $request->return_fee;

            DB::table('partner_delivery')->where('id_partner_delivery', $id_partner_delivery)
                ->update(['name' => $name, 'shipping_fee' => $shipping_fee, 'return_fee' => $return_fee]);

            return Redirect::to('/all-partner-delivery');
        } else {
            return redirect('login');
        }
    }
}
