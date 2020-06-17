<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Session;

class AdminController extends Controller
{
    public function changeAdminInformation()
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {
            $adminInformation = DB::table('admininfo')
                ->where('id_admin', Session::get('id_admin'))
                ->get()
                ->first();
            return view('admin.adminManagement.adminInformation')
                ->with('adminInformation', $adminInformation);
        }
    }

    public function alterAdminInformation(Request $request)
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {

            $name = $request->name;
            $avatar = $request->avatar;
            $email = $request->email;
            $password = $request->password;
            $phone_number = $request->phone_number;
            $address = $request->address;
            $job = $request->job;
            $credit = $request->credit;

            DB::table('admininfo')
                ->where('id_admin', Session::get('id_admin'))
                ->update(['name' => $name, 'email' => $email, 'password' => $password, 'phone_number' => $phone_number, 'address' => $address, 'credit' => $credit,
                    'avatar' => $avatar, 'job' => $job]);

            Session::flash('success', 'Bạn thay đổi thông tin thành công');

            return redirect('/');
        }
    }

    public function addAdmin()
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {

            return view('admin.adminManagement.addAdmin');
        }
    }

    public function saveAdmin(Request $request)
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {

            $name = $request->admin_name;
            $avatar = $request->admin_avatar;
            $email = $request->admin_email;
            $password = $request->admin_password;
            $phone_number = $request->admin_phone_number;
            $address = $request->admin_address;
            $credit = $request->admin_credit;
            $job = $request->admin_job;

            DB::insert('insert into admininfo (name,avatar, email, password, phone_number, address, credit,job, status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$name, $avatar, $email, $password, $phone_number, $address, $credit, $job, 1]);
            return Redirect('/add-admin');
        }
    }

    public function adminComment(Request $request)
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {
            $comment = $request->comment;
            $productid_hidden = $request->productid_hidden;
            $adminid_hidden = $request->adminid_hidden;
            DB::table('coment_admin')
                ->insert(['id_product' => $productid_hidden, 'id_admin' => $adminid_hidden, 'content' => $comment, 'isvalid' => 1]);
            return back();
        }
    }

    public function deleteAdminComment($id_comment)
    {
        if (!Session::get('id_admin'))
            return redirect('login');
        else {
            DB::table('coment_admin')
                ->where('id_coment', $id_comment)
                ->delete();
            return back();
        }
    }
}
