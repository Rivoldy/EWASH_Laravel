<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\t_scale;
use App\Models\pl_send;
class SendOutController extends Controller
{
    public function index(Request $request)
    {

            return view('tra_send_out.index');

    }
}