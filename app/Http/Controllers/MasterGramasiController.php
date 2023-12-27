<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ordersap;
use App\Models\Mgramasi;

class MasterGramasiController extends Controller
{
    public function index (Request $request)
    {
        $seasons = ordersap::distinct('ZSEAS')
        ->where('VKGRP', 'like', 'UQ%')
        ->where('ZSEAS', '!=', '')
        ->orderByDesc('ZSEAS')
        ->pluck('ZSEAS');
     
        return view('tra_style_gram.index',['seasons' => $seasons]);
    }

    public function getData(Request $request)
    {
        $season = $request->input('season');
        $orders = ordersap::where('ZSEAS', $season)->where('VKGRP', 'like', 'UQ%')->where('ZSEAS', '!=', '')->orderBy('crd', 'desc')->distinct('ZSEAS')->get();

        return view('tra_style_gram.data', compact('orders'));
    }

    public function getGram(Request $request)
    {
        $style = $request->input('style');
        $order = ordersap::where('ZMATGEN', $style)->first();
        $jmlsize = ordersap::where('ZMATGEN', $style)->distinct('ZSIZES')->count();
        $gram = Mgramasi::where('g_style', $style)->where('g_val', '!=', 0)->count();

        return view('tra_style_gram.getgram', compact('style', 'order', 'jmlsize', 'gram'));
    }

    public function saveGram(Request $request)
    {
        $style = $request->input('style');
        $nmsize = $request->input('nmsize');
        $gram = $request->input('gram');

        foreach ($nmsize as $key => $size) {
            Mgramasi::updateOrCreate(
                ['g_style' => $style, 'g_size' => $size],
                ['g_val' => $gram[$key], 'updated_at' => now()]
            );
        }
 
        return 'scs';
    }
}

 