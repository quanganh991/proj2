<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class UserInformationController extends Controller
{
    public function changeUserInformation()
    {
        if (!Session::get('id_customer'))
            return redirect('login');
        else {
            $customerInformation = DB::table('customer')
                ->where('id_customer', Session::get('id_customer'))
                ->get()
                ->first();
            return view('users.information.userInformation')
                ->with('customerInformation', $customerInformation);
        }
    }

    public function alterUserInformation(Request $request)
    {
        if (!Session::get('id_customer'))
            return redirect('login');
        else {

            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $phone_number = $request->phone_number;
            $address = $request->address;
            $credit = $request->credit;

            DB::table('customer')
                ->where('id_customer', Session::get('id_customer'))
                ->update(['name' => $name, 'email' => $email, 'password' => $password, 'phone_number' => $phone_number, 'address' => $address, 'credit' => $credit]);

            Session::flash('success', 'Bạn thay đổi thông tin thành công');

            return redirect('/');
        }
    }
}
