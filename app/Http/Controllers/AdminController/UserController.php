<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session, DB, Cart;

class UserController extends Controller
{
    public function displayUser()
    {
        if (Session::get('id_admin')) {
            $allUser = DB::table('customer')
                ->get();
            return view('admin.userManagement.view_all_users')->with('allUser', $allUser);
        } else {
            return redirect('login');
        }
    }

    public function blockUser($id_customer)
    {
        if (Session::get('id_admin')) {
            DB::table('customer')
                ->where('id_customer', $id_customer)
                ->update(['status' => 0]);
            return back();
        } else {
            return redirect('login');
        }
    }

    public function unBlockUser($id_customer)
    {
        if (Session::get('id_admin')) {
            DB::table('customer')
                ->where('id_customer', $id_customer)
                ->update(['status' => 1]);
            return back();
        } else {
            return redirect('login');
        }
    }

    public function deleteComment($id_comment)
    {
        if (Session::get('id_admin')) {
            DB::table('coment')
                ->where('id_coment', $id_comment)
                ->delete();
            return back();
        } else {
            return redirect('login');
        }
    }
}
