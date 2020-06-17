<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session, Cart, Math;
use Illuminate\Support\Facades\Redirect;
use function MongoDB\BSON\toJSON;

class PayController extends Controller
{
    //
    public function previewOrder()
    {
        return view('users.pay.previewOrder');
    }

    //
    public function noteDetail(Request $request)    //nhận 7 mục + ID tỉnh thành từ phía previewOrder.blade.php
    {
        $customerInformation = DB::table('customer')
            ->where('id_customer', Session::get('id_customer'))
            ->get()
            ->first();  //lấy thông tin người đặt hàng


        $subprice = array();    //lấy giá bìa (chưa vat) từ previewOrder.blade.php
        $id_partner_delivery = array(); //lấy đối tác giao hàng từ previewOrder.blade.php


        $content = Cart::content();
        $numberOfItems = 0;
        foreach ($content as $eachItem) {
            $subprice[$numberOfItems] = $request->subprice[$numberOfItems];   //giá bìa = 0.9 * giá hiển thị trên web, đã nhân ở previewOrder.blade.php
            $id_partner_delivery[$numberOfItems] = $request->partner_delivery[$numberOfItems];  //lấy mục đối tác giao hàng previewOrder.blade.php
            $numberOfItems += 1;
        }

        $dest = $request->shipping_province;    //lấy địa chỉ nhận hàng
        $VAT = array(); //mỗi mặt hàng có thuế = 0.1 * giá price đã VAT = giá bìa chưa VAT / 9
        $shipping_fee = array();    //mỗi mặt hàng trong cart sẽ có phí ship khác nhau
        $totalEachCost = array();   //tổng tiền của mỗi mặt hàng trong giỏ hàng
        $content = Cart::content();
        $totalcost = 0; //tổng tiền của cả cái giỏ hàng
        $i = 1;
        foreach ($content as $eachContentItem) {    //duyệt từng sản phẩm trong giỏ hàng
            $produc = DB::table('product')->where('id_product', $eachContentItem->id)->get()->first();  //chứa id mặt hàng thứ i trong giỏ hàng
            $shipping_fee[$i - 1] = 0;
            //cột position trong bảng province = khoảng cách từ nhà sách đến nơi nhận hàng của khách
            $distanceCoefficient = abs(DB::table('province')->where('id_province', $dest)->get()->first()->position);//tính khoảng cách giao hàng
            $fee = DB::table('partner_delivery')->where('id_partner_delivery', $id_partner_delivery[$i - 1])->get()->first();   //lấy thông tin đối tác giao hàng
            $shipping_fee[$i - 1] = $distanceCoefficient * $fee->shipping_fee; //tính toán xong phí ship

            $VAT[$i - 1] = 0.1 * $produc->price; //tiền thuế = 10% giá trị sản phẩm

            $totalEachCost[$i - 1] = $shipping_fee[$i - 1] + ($eachContentItem->qty) * ($VAT[$i - 1] + $subprice[$i - 1]); //tổng chi phí của 1 mặt hàng trong đơn hàng = (giá bìa + VAT)* Số lượng + phí ship
            $totalcost += $totalEachCost[$i - 1];   //chi phí của cả cái giỏ hàng = tổng chi phí các mặt hàng trong giỏ
            $i++;
        }

        return view('users.pay.noteDetail')
            //người nào đặt cái đơn này
            ->with('customerInformation', $customerInformation)
            ->with('dest', $dest)
            ->with('subprice', $subprice)   //trong orderDetail
            ->with('id_partner_delivery', $id_partner_delivery) //trong orderDetail
            ->with('shipping_fee', $shipping_fee)   //trong orderDetail
            ->with('totalcost', $totalcost)
            ->with('totalEachCost', $totalEachCost) //trong orderDetail
            ->with('VAT', $VAT);    //trong orderDetail
    }


    //
    public function saveCustomerPayment(Request $request)
    {   //sau khi đã xác nhận xong tất cả
        $shipping_email = $request->shipping_email;
        $shipping_name = $request->shipping_name;
        $shipping_address = $request->shipping_address;
        $shipping_phone = $request->shipping_phone;
        $shipping_notes = $request->shipping_notes;
        $payment_option = $request->payment_option;
        $id_customer = $request->id_customer;
        $shipping_province = $request->shipping_province;

        $VAT = array(); //mỗi mặt hàng có thuế = 0.1 * giá price đã VAT = giá bìa chưa VAT / 9
        $subprice = array();
        $id_partner_delivery = array();
        $shipping_fees = array();


        $content = Cart::content();
        $numberOfItems = 0;
        foreach ($content as $eachItem) {
            $subprice[$numberOfItems] = $request->subprice[$numberOfItems];
            $id_partner_delivery[$numberOfItems] = $request->partner_delivery[$numberOfItems];
            $numberOfItems += 1;
        }


        $content = Cart::content();
        $totalcost = 0;
        foreach ($content as $eachItem) {
            $totalcost += $eachItem->qty * $eachItem->price;
        }

        //lưu vào database.order
        DB::table('oder')
            ->insert(['id_customer' => $id_customer, 'date' => date('Y-m-d H:i:s'), 'isapproved' => 0, 'note' => $shipping_notes,
                'id_province' => $shipping_province, 'totalcost' => $totalcost]);   //totalcost ở đây chỉ là tính tổng các giá trị phía sau bìa chứ chưa có phí ship
        //lưu vào database.order_detail
        $idoder = DB::table('oder')->get()->last();
        $id_oder = $idoder->id_oder;
        $dest = $idoder->id_province;       //Nơi nhận hàng

        $totalcost = 0;
        $i = 1;
        foreach ($content as $eachContentItem) {
            $produc = DB::table('product')->where('id_product', $eachContentItem->id)->get()->first();

            $distanceCoefficient = abs(DB::table('province')->where('id_province', $dest)->get()->first()->position);   //khoảng cách nhận hàng
            $fee = DB::table('partner_delivery')->where('id_partner_delivery', $id_partner_delivery[$i - 1])->get()->first();
            $shipping_fees[$i - 1] = $distanceCoefficient * $fee->shipping_fee; //tính toán xong phí ship


            $VAT[$i - 1] = 0.1 * $produc->price;
            $totalEachCost[$i - 1] = $shipping_fees[$i - 1] + ($eachContentItem->qty) * ($VAT[$i - 1] + $subprice[$i - 1]); //tổng chi phí của 1 mặt hàng trong đơn hàng = (giá bìa + VAT)* Số lượng + phí ship

            DB::table('oder_detail')
                ->insert(['item_order' => $i, 'id_oder' => $id_oder, 'id_product' => $eachContentItem->id, 'shipping_fee' => $shipping_fees[$i - 1],
                    'quantity' => $eachContentItem->qty, 'discount' => Cart::discount(), 'subprice' => $subprice[$i - 1],
                    'id_partner_delivery' => $id_partner_delivery[$i - 1], 'VAT' => $VAT[$i - 1], 'boughtdate' => date('Y-m-d H:i:s'),
                    'totaleachcost'=>$totalEachCost[$i - 1]]);
            $totalcost += $totalEachCost[$i - 1];   //chi phí của cả cái giỏ hàng = tổng chi phí các mặt hàng trong giỏ
            $i++;

        }

        DB::table('oder')
            ->where('id_oder', $id_oder)
            ->update(['totalcost' => $totalcost]);

        DB::table('notification')
            ->insert(['id_oder'=>$id_oder,'isread'=>0,'datenoti'=>date('Y-m-d H:i:s'),
                'context'=>"Đơn hàng ".$id_oder." đã được gửi đi và đang chờ xác nhận từ BookShop, chúng tôi sẽ thông báo sớm nhất về
                trạng thái đơn hàng của quý khách"]);
        $tb = Session::get('notification') + 1;
        Session::remove('notification');
        Session::put('notification',$tb);

        //
        return view('users.pay.savePayment')
            ->with('shipping_email', $shipping_email)   //không lưu vào DB
            ->with('shipping_name', $shipping_name) //Không lưu vào DB
            ->with('shipping_address', $shipping_address)   //Ko lưu vào DB
            ->with('shipping_phone', $shipping_phone)   //Ko lưu vào DB
            ->with('payment_option', $payment_option)   //ko lưu vào DB
            ->with('shipping_fees', $shipping_fees)
            ->with('shipping_notes', $shipping_notes)
            ->with('id_customer', $id_customer)
            ->with('id_partner_delivery', $id_partner_delivery)
            ->with('totalcost', $totalcost)
            ->with('subprice', $subprice)
            ->with('totalEachCost',$totalEachCost)
            ->with('boughtdate',date('Y-m-d H:i:s'))
            ->with('VAT',$VAT);
    }

}
