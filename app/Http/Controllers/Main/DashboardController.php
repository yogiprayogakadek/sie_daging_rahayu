<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
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
            $data = DB::table('produk')
                    ->select('produk.id', 'produk.nama', DB::raw('SUM(detail_penjualan.kuantitas) as kuantitas'))
                    ->leftJoin('detail_penjualan', 'produk.id', '=', 'detail_penjualan.produk_id')
                    ->leftJoin('penjualan', 'detail_penjualan.penjualan_id', '=', 'penjualan.id')
                    ->whereMonth('penjualan.tanggal_transaksi', $request->bulan)
                    ->whereYear('penjualan.tanggal_transaksi', $request->tahun)
                    ->groupBy('produk.id')
                    ->get();
        }
        foreach ($data as $key => $value) {
            $chart[] = [
                'nama_produk' => $value->nama,
                'jumlah' => $value->kuantitas,
            ];
        }
        // $maxVal = array_keys(array_column($chart, 'jumlah'), max(array_column($chart, 'jumlah')));
        // $minVal = array_keys(array_column($chart, 'jumlah'), min(array_column($chart, 'jumlah')));

        // $terendahProduk = [];
        // $terendahValue = [];
        // $terendah = [];
        // for($i = 0; $i < count($minVal); $i++) {
        //     array_push($terendahValue, $chart[$minVal[$i]]['jumlah']);
        //     array_push($terendahProduk, $chart[$minVal[$i]]['nama_produk']);
        //     array_push($terendah, $chart[$minVal[$i]]['nama_produk'] . ' dengan ' . $chart[$minVal[$i]]['jumlah'] . ' buah');
        // }

        // $tertinggiProduk = [];
        // $tertinggiValue = [];
        // $tertinggi = [];
        // for($i = 0; $i < count($maxVal); $i++) {
        //     array_push($tertinggiValue, $chart[$maxVal[$i]]['jumlah']);
        //     array_push($tertinggiProduk, $chart[$maxVal[$i]]['nama_produk']);
        //     array_push($tertinggi, $chart[$maxVal[$i]]['nama_produk'] . ' ' . $chart[$maxVal[$i]]['jumlah'] . ' buah');
        // }

        $view = [
            'data' => view('main.dashboard.chart.index')->with([
                'bulan' => bulan()[$request->bulan-1],
                'tahun' => $request->tahun,
                'chart' => $chart,
                'totalData' => count($data),
                // 'tertinggiProduk' => str_replace(',', ', ', str_replace(['["', '"]', '"'], '', json_encode($tertinggiProduk))),
                // 'tertinggiValue' => str_replace(' ', ', ', implode(" ", $tertinggiValue)),
                // 'terendahProduk' => str_replace(',', ', ', str_replace(['["', '"]', '"'], '', json_encode($terendahProduk))),
                // 'terendahValue' => str_replace(' ', ', ', implode(" ", $terendahValue)),
                
                // 'tertinggi' => str_replace(',', ', ', str_replace(['["', '"]', '"'], '', json_encode($tertinggi))),
                // 'terendah' => str_replace(',', ', ', str_replace(['["', '"]', '"'], '', json_encode($terendah)))
            ])->render()
        ];

        return response()->json($view);
    }
}
