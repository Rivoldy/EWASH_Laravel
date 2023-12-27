<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_bag;
class detailplRfidController extends Controller
{
    public function index()
    {
        $styles = t_bag::distinct()->pluck('style');
        
        return view('rep_pack_detailpl_rfid.index', compact('styles'));
    }
}
