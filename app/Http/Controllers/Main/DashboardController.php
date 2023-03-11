<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\ProdukAtribut;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('main.dashboard.index');
    }

    public function chart(Request $request)
    {         
        $chart = array();
        if($request->filter == 'product') {
            $start_date = DateTime::createFromFormat('d-m-Y', $request->start_date);
            $end_date = DateTime::createFromFormat('d-m-Y', $request->end_date);
            $data = DB::table('produk')
                    ->select('produk.id', 'produk.nama', DB::raw('SUM(detail_penjualan.kuantitas) as kuantitas'))
                    ->leftJoin('detail_penjualan', 'produk.id', '=', 'detail_penjualan.produk_id')
                    ->leftJoin('penjualan', 'detail_penjualan.penjualan_id', '=', 'penjualan.id')
                    ->whereBetween('penjualan.tanggal_transaksi', [$start_date->format('Y-m-d'), $end_date->format('Y-m-d')])
                    // ->whereMonth('penjualan.tanggal_transaksi', $request->bulan)
                    // ->whereYear('penjualan.tanggal_transaksi', $request->tahun)
                    ->groupBy('produk.id')
                    ->get();
        }
        foreach ($data as $key => $value) {
            $chart[] = [
                'nama_produk' => $value->nama,
                'jumlah' => $value->kuantitas,
            ];
        }

        // Terlaris
        $produk = DB::table('produk')
            ->select('produk.id', 'produk.nama', DB::raw('SUM(detail_penjualan.kuantitas) as kuantitas'))
            ->leftJoin('detail_penjualan', 'produk.id', '=', 'detail_penjualan.produk_id')
            ->leftJoin('penjualan', 'detail_penjualan.penjualan_id', '=', 'penjualan.id')
            ->whereBetween('penjualan.tanggal_transaksi', [$start_date->format('Y-m-d'), $end_date->format('Y-m-d')])
            ->groupBy('produk.id')
            ->get()->toArray();

        usort($produk, function($a, $b) {
            return $b->kuantitas - $a->kuantitas;
        });

        $view = [
            'data' => view('main.dashboard.chart.index')->with([
                'chart' => $chart,
                'totalData' => count($data),
                'tanggal' => $start_date->format('Y-m-d') . ' s/d ' . $end_date->format('Y-m-d'),
                'tertinggi' => current($produk),
                'terendah' => end($produk)
            ])->render()
        ];

        return response()->json($view);
    }

    public function chartTerlaris(Request $request)
    {
        // TERLARIS
        $start_date = DateTime::createFromFormat('d-m-Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d-m-Y', $request->end_date);

        $data = DB::table('produk')
            ->select('produk.id', 'produk.nama', DB::raw('SUM(detail_penjualan.kuantitas) as kuantitas'))
            ->leftJoin('detail_penjualan', 'produk.id', '=', 'detail_penjualan.produk_id')
            ->leftJoin('penjualan', 'detail_penjualan.penjualan_id', '=', 'penjualan.id')
            ->whereBetween('penjualan.tanggal_transaksi', [$start_date->format('Y-m-d'), $end_date->format('Y-m-d')])
            ->groupBy('produk.id')
            ->get()->take(5)->toArray();

        usort($data, function($a, $b) {
            return $b->kuantitas - $a->kuantitas;
        });

        $terlaris = [];
        $produk = "";
        $kuantitas = "";
        foreach($data as $i => $v) {
            $terlaris[] = [
                'nama_produk' => $v->nama,
                'kuantitas' => $v->kuantitas,
            ];
            $produk .= $v->nama . ', ';
            $kuantitas .= $v->kuantitas . ', ';
        }

        // dd(implode(', ', array_map(function ($entry) {
        //     return ($entry[key($entry)]);
        // }, $terlaris)));

        // dd(rtrim($produk, ', '));

        $view = [
            'data' => view('main.dashboard.chart.terlaris')->with([
                'terlaris' => $terlaris,
                'produk' => substr_replace(rtrim($produk, ', '), ' dan', strrpos(rtrim($produk, ', '), ','), 1),
                'kuantitas' => substr_replace(rtrim($kuantitas, ', '), ' dan', strrpos(rtrim($kuantitas, ', '), ','), 1),
                'tanggal' => $start_date->format('Y-m-d') . ' s/d ' . $end_date->format('Y-m-d'),
            ])->render()
        ];

        // dd($terlaris);

        return response()->json($view);
    }

    public function chartPendapatan(Request $request)
    {
        // TERLARIS
        $start_date = DateTime::createFromFormat('d-m-Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d-m-Y', $request->end_date);

        $data = Penjualan::groupBy('tanggal_transaksi')
                    ->select('tanggal_transaksi')
                    ->selectRaw('sum(total) as total')
                    ->whereBetween('tanggal_transaksi', [$start_date, $end_date])
                    ->get();

        $pendapatan = [];
        foreach($data as $i => $v) {
            $pendapatan[] = [
                'tanggal' => date_format(date_create($v->tanggal_transaksi), 'd-m-Y'),
                'total' => $v->total,
            ];
        }

        // dd(current($pendapatan)['tanggal']);

        $view = [
            'data' => view('main.dashboard.chart.pendapatan')->with([
                'pendapatan' => $pendapatan,
                'tertinggi' => current($pendapatan),
                'terendah' => end($pendapatan),
            ])->render()
        ];


        return response()->json($view);
    }
}
