<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_scale;

class detailplController extends Controller
{
    public function index(){
        $styles = t_scale::distinct()->pluck('style');
            
            return view('rep_pack_detailpl.index', compact('styles'));
        }
}
