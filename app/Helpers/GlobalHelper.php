<?php

use App\Models\ProdukAtribut;
use Illuminate\Support\Facades\DB;

    function account_image()
    {
        return asset(auth()->user()->foto);
    }

    function username()
    {
        return auth()->user()->username;
    }

    function role()
    {
        return auth()->user()->role;
    }

    function convertToRupiah($jumlah)
    {
        return 'Rp' . number_format($jumlah, 0, '.', '.');
    }

    function cart()
    {
        return \Cart::session(auth()->user()->id)->getContent();
    }

    function clearCart()
    {
        return \Cart::session(auth()->user()->id)->clear();
    }

    function subTotal()
    {
        $user_id = auth()->user()->id;
        $cart = \Cart::session($user_id)->getContent();
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item->price * $item->quantity;
        }

        return convertToRupiah($subtotal);
    }

    function generateTransactionCode()
    {
        return "TRANSID-" . strtoupper(uniqid());
    }

    function menu()
    {
        $menu = [
            // 'Kategori', 
            'Produk', 
            // 'Staff', 
            'Penjualan'
        ];

        return $menu;
    }

    function RouteURL()
    {
        $url = [
            // 0 => 'kategori.index',
            0 => 'produk.index',
            // 2 => 'staff.index',
            1 => 'penjualan.index'
        ];

        return $url;
    }

    function totalData($model)
    {
        $a = 'App\Models\\' . $model;
        $total = $a::count();
        return $total;
    }

    function produkMinStok()
    {
        $stok = ProdukAtribut::all()->min('stok');
        $atribut = ProdukAtribut::with('produk')->where('stok', $stok)->get();
        $produk = "";
        foreach($atribut as $att) {
            $produk .= $att->produk->nama . ', ';
        }

        $data = [
            'stok' => $stok,
            'produk' => substr($produk, 0, -1),
        ];

        return $data;
    }

    function bulan()
    {
        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    
        return $bulan;
    }

    function search($array, $key, $value)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, search($subarray, $key, $value));
            }
        }

        return $results;
    }

    function bestSeller()
    {
        $data = DB::table('detail_penjualan')
                ->select('produk.nama', DB::raw('SUM(kuantitas) as kuantitas'))
                ->join('produk', 'detail_penjualan.produk_id', 'produk.id')
                ->groupBy('produk_id')
                ->get();
        $arr = json_decode(json_encode($data), true);
        $max = max(array_column($arr, 'kuantitas'));
        
        return search($arr, 'kuantitas', $max);
    }

    function worstSeller()
    {
        $data = DB::table('detail_penjualan')
                ->select('produk.nama', DB::raw('SUM(kuantitas) as kuantitas'))
                ->join('produk', 'detail_penjualan.produk_id', 'produk.id')
                ->groupBy('produk_id')
                ->get();
        $arr = json_decode(json_encode($data), true);
        $min = min(array_column($arr, 'kuantitas'));
        
        return search($arr, 'kuantitas', $min);
    }