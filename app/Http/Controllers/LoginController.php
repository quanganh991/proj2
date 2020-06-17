<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB, Session;

class LoginController extends Controller
{
    public function login_check(Request $request)
    {
        $email = $request->email_account;
        $password = $request->password_account;
        $isAdmin = $request->isAdmin;
        if (!$isAdmin) { //nếu ko phải admin
            $resultUser = DB::table('customer')->where('email', $email)->where('password', $password)->first();
            if ($resultUser == null)
                $check = false;
            else $check = true;
            if ($resultUser) {    //nếu người dùng đăng nhập đúng
                Session::put('login', true);
                Session::put('id_customer', $resultUser->id_customer);
                Session::remove('id_admin');

                $allUserNotification = DB::table('notification')
                    ->join('oder','notification.id_oder','=','oder.id_oder')
                    ->where('oder.id_customer', Session::get('id_customer'))
                    ->where('notification.isread',0)
                    ->orderBy('notification.datenoti','DESC')
                    ->get();
                $cnt = count($allUserNotification);
                Session::put('notification',$cnt);
                    return view('users.home');
            } else {
                $alert = 'Tài khoản hoặc mật khẩu không chính xác';
                return view('users.login', compact('check', 'alert'));
            }
        } else { //nếu là admin
            $resultAdmin = DB::table('admininfo')->where('email', $email)->where('password', $password)->first();
            $check = $resultAdmin;
            if ($resultAdmin == null)
                $check = false;
            else $check = true;
            if ($resultAdmin) {   //nếu admin đăng nhập đúng
                Session::put('login', true);
                Session::put('id_admin', $resultAdmin->id_admin);
                return view('admin.welcomeAdmin');
            } else {
                $alert = 'Bạn có phải là admin không ?';
                return view('users.login', compact('check', 'alert'));
            }
        }
    }

    public function login()
    {
        return view('users.login');
    }

    public function logout()
    {
        if (Session::get('id_customer') || Session::get('id_admin')) {
            Session::put('login', false);
            Session::remove('id_customer');
            Session::remove('id_admin');
            Session::remove('notification');
            return redirect('login');
        } else return redirect('/');
    }

    public function welcomeAdmin()
    {
        if (Session::get('id_admin')) {
            return view('admin.welcomeAdmin');
        } else {
            return redirect('login');
        }
    }
}
