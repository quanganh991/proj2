<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session,DB,Cart;
class SessionController extends Controller
{
    public function viewAllSession(){
        return view('admin.session.viewAllSession');
    }
}
