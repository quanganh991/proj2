<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB, Session;
class SignupController extends Controller
{
    public function signup_check(Request $request){
        $name = $request->customer_name;
        $email = $request->customer_email;
        $password = $request->customer_password;
        $phone = $request->customer_phone;
        $address = $request->customer_address;
        $credit = $request->customer_credit;
        $result = DB::table('customer')->where('email',$email)->first();


        if($result){    //nếu email đã tồn tại (được tìm thấy trong csdl)
            return Redirect::to('/signup');
        }else{  //nếu ko tìm thấy email trong csdl-> Hợp lệ
            Session::put('email',$email);
            DB::insert('insert into customer (name, email, password, phone_number, address, credit, status) values (?, ?, ?, ?, ?, ?, ?)', [$name, $email,$password, $phone, $address, $credit, 1]);
            return view('users.home');
        }
    }

    public function signup(){
        return view('users.signup');
    }
}
