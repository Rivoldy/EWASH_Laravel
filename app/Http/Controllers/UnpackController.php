<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_scale;

class UnpackController extends Controller
{
    public function index(){
        $styles = t_scale::distinct()->pluck('style');
            
            return view('tra_unpack.main', compact('styles'));
        }
}
