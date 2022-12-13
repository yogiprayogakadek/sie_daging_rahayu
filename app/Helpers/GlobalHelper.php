<?php

use App\Models\ProdukAtribut;

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
        $stok = ProdukAtribut::with('produk')->selectRaw('min(stok) as min, produk_id')->first();
        $arr = [
            'stok' => $stok,
            'produk' => $stok->produk->nama,
            'route' => 'produk.index',
        ];

        return $arr;
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