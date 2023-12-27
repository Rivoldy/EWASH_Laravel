<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_bag;
class scanplRfidController extends Controller
{
    public function index(){
        $styles = t_bag::distinct()->pluck('style');
            
            return view('rep_pack_scanpl_rfid.index', compact('styles'));
        }
}
