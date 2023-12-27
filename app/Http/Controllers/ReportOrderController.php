<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_scale;
class ReportOrderController extends Controller
{
    public function index()
    {
        $styles = t_scale::distinct('style')->pluck('style');

        return view('rep_order_status.main', compact('styles'));
    }
}
