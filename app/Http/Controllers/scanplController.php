<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_scale;

class scanplController extends Controller
{
    public function index(){
    $styles = t_scale::distinct()->pluck('style');
        
        return view('rep_pack_scanpl.index', compact('styles'));
    }
}
