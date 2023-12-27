<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\t_scale;

class ReportAWdetailController extends Controller
{
    public function index()
    {
        $styles = t_scale::distinct()->pluck('style');
        
        return view('rep_afterwash_detailpl.report', compact('styles'));
    }

}