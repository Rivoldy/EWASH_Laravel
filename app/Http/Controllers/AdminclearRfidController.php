<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminclearRfidController extends Controller
{
    public function index(){
        return view('admin_clear_rfid.main');
    }
}
