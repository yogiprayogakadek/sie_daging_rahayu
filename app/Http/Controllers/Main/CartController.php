<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $produk = Produk::find($request->id);
        $user_id = auth()->user()->id;

        try {
            if(\Cart::session($user_id)->get($produk->id)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Produk sudah ada di keranjang',
                    'title' => 'Gagal',
                ]);
            } else {
                if($produk->atribut == null || $produk->atribut->stok <= 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Tidak ada stok untuk produk ini',
                        'title' => 'Gagal',
                    ]);
                } else {
                    \Cart::session($user_id)->add([
                        'id' => $produk->id,
                        'name' => $produk->nama,
                        'price' => $produk->harga,
                        'quantity' => 1,
                        // 'quantity' => $request->jumlah,
                        'associatedModel' => $produk,
                    ]);
    
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Produk berhasil ditambahkan ke keranjang',
                        'title' => 'Berhasil',
                        'cart' => cart(),
                        'subtotal' => subTotal()
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' =>$e->getMessage(),
                'title' => 'Gagal',
            ]);
        }
    }

    public function update(Request $request)
    {
        $user_id = auth()->user()->id;
        $produk = Produk::with('atribut')->where('id', $request->id)->first();
        if($request->qty > $produk->atribut->stok) {
            return response()->json([
                'status' => 'info',
                'message' => 'Stok tidak mencukupi, stok yang tersedia ' . $produk->atribut->stok,
                'title' => 'Info',
            ]);
        } else {
            \Cart::session($user_id)->update($request->id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->qty
                ],
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Kuantitas berhasil diubah',
                'title' => 'Berhasil',
                'cart' => cart(),
                'subtotal' => subTotal()
            ]);
        }
    }

    public function remove($id)
    {
        $user = auth()->user()->id;
        \Cart::session($user)->remove($id);
        return response()->json([
            'cart' => cart(),
            'subtotal' => subTotal(),
            'status' => 'success',
            'message' => 'Produk berhasil dihapus dari keranjang',
            'title' => 'Berhasil'
        ]);
    }

    public function checkout(Request $request)
    {
        try {
            // before discount
            $totalBeforeDiscount = ($request->total*100)/(100-$request->discount);
            $point = floor($totalBeforeDiscount/20000);

            $penjualan = Penjualan::create([
                'kode_transaksi' => generateTransactionCode(),
                'staff_id' => auth()->user()->staff->id,
                'diskon' => $request->discount,
                'total' => $request->total,
                'tanggal_transaksi' => date('Y-m-d H:i:s')
            ]);

            foreach (cart() as $d) {
                $produk = Produk::find($d->id);
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $d->id,
                    'kuantitas' => $d->quantity,
                ]);

                $produk->atribut->update([
                    'stok' => $produk->atribut->stok - $d->quantity
                ]);
            }

            clearCart();

            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil diproses',
                'title' => 'Berhasil',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Peminjaman gagal diproses',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function check()
    {
        dd(\Cart::session(auth()->user()->id)->getContent());
    }
}
