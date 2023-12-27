<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_bag;
class detailAWplRfidController extends Controller
{
    public function index(){
        $styles = t_bag::distinct()->pluck('style');
            
            return view('rep_afterwash_detailpl_rfid.index', compact('styles'));
        }
}
