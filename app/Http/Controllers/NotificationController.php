<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Session,Cart;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    public function viewAllController()
    {    //xem các thông báo của người dùng
        if (Session::get('id_customer')) {
            $allUserNotification = DB::table('notification')
                ->join('oder','notification.id_oder','=','oder.id_oder')
                ->where('oder.id_customer', Session::get('id_customer'))
                ->orderBy('notification.datenoti','DESC')
                ->get();
        return view('users.notification.notification')->with('allUserNotification', $allUserNotification);
        } else {
            return redirect('login');
        }
    }

    public function markAsRead($id_notification){
        if (Session::get('id_customer')) {
            DB::table('notification')
                ->where('id_notification',$id_notification)
                ->update(['isread' => 1]);
            $tb = Session::get('notification') - 1;
            Session::remove('notification');
            Session::put('notification',$tb);
            return Redirect::to('/user-view-notification');
        } else {
            return redirect('login');
        }
    }
}
