<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('main.penjualan.index');
    }

    public function search($slug)
    {
        $produk = Produk::with('atribut')->where('nama', 'LIKE', '%' . $slug . '%')->where('status', true)->get();

        return response()->json($produk);
    }

    public function detail()
    {
        $data = Penjualan::with('detail.produk', 'staff')->orderBy('created_at', 'DESC')->get();
        return view('main.penjualan.detail', compact('data'));
    }

    public function detailRender()
    {
        $data = Penjualan::with('detail.produk', 'staff')->orderBy('created_at', 'DESC')->get();
        
        $view = [
            'data' => view('main.penjualan.detail.update', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function detailFilter($start, $end)
    {
        $data = Penjualan::with('detail.produk', 'staff')->whereBetween('tanggal_transaksi', [$start, $end])->orderBy('created_at', 'DESC')->get();
        $view = [
            'data' => view('main.penjualan.detail.update', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function print($start, $end)
    {
        $total = 0;
        $data = Penjualan::with('detail.produk', 'staff')->whereBetween('tanggal_transaksi', [$start, $end])->get();

        foreach($data as $d) {
            $total += $d->total;
        }

        $pdf = \PDF::loadView('main.penjualan.detail.print', [
            'data' => $data,
            'total' => $total
        ]);
        // return $pdf->stream();
        $pdf->setPaper([0,0,609.4488,935.433], 'landscape');
        return $pdf->stream('Laporan-Penjualan-' . time() . '.pdf');
        // $view = [
        //     'data' => view('main.penjualan.detail.print', compact('data'))->render()
        // ];
        
        // return response()->json($view);
    }

    public function detailTransaksi($id)
    {
        $detail = DetailPenjualan::with('produk')->where('penjualan_id', $id)->get();
        
        $data = [];
        foreach($detail as $key => $det) {
            $data[] = [
                'no' => ($key+1),
                'produk' => $det->produk->nama,
                'harga' => convertToRupiah($det->produk->harga),
                'satuan' => $det->produk->satuan,
                'kuantitas' => $det->kuantitas,
                'total' => convertToRupiah($det->produk->harga * $det->kuantitas)
            ];
        }

        // $total = 0;
        // foreach($detail as $key => $d) {
        //     $total += ($det->produk->harga * $det->kuantitas) - (($det->produk->harga * $det->kuantitas) * $);
        // }
        // dd($total);
        // $data['total_bayar'] = 


        return response()->json($data);
    }
}
