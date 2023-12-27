<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\pl_send;

class ReportPCLController extends Controller
{
    public function index()
    {
        $pl_send = pl_send::all(); 
        return view('rep_packlist.report', compact('pl_send'));
    }
}

