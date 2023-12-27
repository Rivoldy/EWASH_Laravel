<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\pl_send;
use App\Models\t_scale;

class ReportAWController extends Controller
{
    public function index()
    {
        // Fetch distinct styles from the database
        $styles = pl_send::distinct()
            ->join('t_scale', 'pl_send.id', '=', 't_scale.pl_id')
            ->select('pl_send.style')
            ->get()
            ->map(function ($row) {
                return $row->style;
            });

        return view('rep_afterwash_actpl.main', compact('styles'));
    }

    public function generateReport(Request $request)
    {
        $style = $request->input('style');
        $kp = $request->input('kp');
        $tgl = $request->input('tgl');

        // Perform your database queries using Eloquent to get the report data
        // Modify the queries accordingly

        $data = t_scale::select('color', DB::raw('SUM(nw) as nett'), DB::raw('SUM(gw) as gross'), DB::raw('COUNT(DISTINCT(bid)) as karung'))
            ->join('pl_send', 'pl_send.id', '=', 't_scale.pl_id')
            ->where('pl_send.style', $style)
            ->where('t_scale.kp', $kp)
            ->where('t_scale.closing_status', 1)
            ->when($tgl != 'All', function ($query) use ($tgl) {
                return $query->where('t_scale.closing', 'like', $tgl . '%');
            })
            ->groupBy('color')
            ->get();

        return view('rep_afterwash_actpl.data', compact('data'));
    }

    public function getData(Request $request)
    {
        $style = $request->input('style');
        $kp = $request->input('kp');

        // Fetch distinct KP or dates using Eloquent
        // Modify the queries accordingly

        $data = pl_send::distinct()
            ->when($style != '', function ($query) use ($style) {
                return $query->where('style', $style);
            })
            ->pluck('closing'); // Assuming 'closing' is the date field

        if ($data->contains('All')) {
            $data->forget($data->search('All'));
            $data->prepend('All', 'All');
        }

        return response()->json($data);
    }
}
