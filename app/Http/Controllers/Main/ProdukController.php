<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Kategori;
use App\Models\Pemasok;
use App\Models\Produk;
use App\Models\ProdukAtribut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = DB::table('detail_penjualan')
                        ->select('produk.nama')
                        ->selectRaw('SUM(kuantitas) as kuantitas')
                        ->join('produk', 'detail_penjualan.produk_id', 'produk.id')
                        ->groupBy('produk_id')
                        ->get();
                        // dd(array_search(max(array_key($produk)), $produk));
        return view('main.produk.index');
    }

    public function render() 
    {
        $produk = Produk::with('atribut')->get();
        $view = [
            'data' => view('main.produk.render')->with([
                'produk' => $produk
            ])->render()
        ];

        return response()->json($view);
    }

    public function create() 
    {
        $satuan = [
            'Kg', 'Ekor', 'Gram'
        ];
        $pemasok = Pemasok::pluck('nama', 'id')->prepend('Pilih pemasok...', '')->toArray();
        $kategori = Kategori::pluck('nama', 'id')->prepend('Pilih kategori...', '')->toArray();
        $view = [
            'data' => view('main.produk.create', compact('kategori', 'pemasok', 'satuan'))->render()
        ];

        return response()->json($view);
    }

    public function store(ProdukRequest $request)
    {
        try {
            $data = [
                'nama' => $request->nama,
                'satuan' => $request->satuan,
                'kategori_id' => $request->kategori,
                'harga' => preg_replace('/[^0-9]/', '', $request->harga),
                'pemasok_id' => $request->pemasok,
            ];

            if($request->hasFile('gambar')) {
                //get filename with extension
                $filenamewithextension = $request->file('gambar')->getClientOriginalName();

                //get file extension
                $extension = $request->file('gambar')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->nama . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/media/produk';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                $img = Image::make($request->file('gambar')->getRealPath());
                $img->resize(512, 512);
                $img->save($save_path . '/' . $filenametostore);

                $data['gambar'] = $save_path . '/' . $filenametostore;
            }
            Produk::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Data gagal tersimpan',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id) 
    {
        $satuan = [
            'Kg', 'Ekor', 'Gram'
        ];
        $produk = Produk::with('atribut')->where('id', $id)->first();
        $pemasok = Pemasok::pluck('nama', 'id')->prepend('Pilih pemasok...', '')->toArray();
        $kategori = Kategori::pluck('nama', 'id')->prepend('Pilih kategori...', '')->toArray();
        $view = [
            'data' => view('main.produk.edit', compact('kategori', 'produk', 'pemasok', 'satuan'))->render()
        ];

        return response()->json($view);
    }

    public function update(ProdukRequest $request)
    {
        try {
            $produk = Produk::find($request->id);
            $data = [
                'nama' => $request->nama,
                'satuan' => $request->satuan,
                'kategori_id' => $request->kategori,
                'harga' => preg_replace('/[^0-9]/', '', $request->harga),
                'status' => $request->status,
                'pemasok_id' => $request->pemasok
            ];

            if($request->hasFile('gambar')) {
                //get filename with extension
                $filenamewithextension = $request->file('gambar')->getClientOriginalName();

                //get file extension
                $extension = $request->file('gambar')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->name . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/media/produk';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                $img = Image::make($request->file('gambar')->getRealPath());
                $img->resize(512, 512);
                $img->save($save_path . '/' . $filenametostore);

                $data['gambar'] = $save_path . '/' . $filenametostore;
            }
            
            $produk->update($data);

            // update attribute
            ProdukAtribut::updateOrCreate([
                'produk_id' => $request->id
            ], [
                'produk_id' => $request->id,
                'stok' => $request->stok,
                'produk_rejected' => $request->rejected,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Data gagal tersimpan',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
}
