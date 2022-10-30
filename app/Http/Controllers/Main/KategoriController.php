<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('main.kategori.index');
    }

    public function render() 
    {
        $kategori = Kategori::all();

        $view = [
            'data' => view('main.kategori.render')->with([
                'kategori' => $kategori
            ])->render()
        ];

        return response()->json($view);
    }

    public function create() 
    {
        $view = [
            'data' => view('main.kategori.create')->render()
        ];

        return response()->json($view);
    }

    public function store(KategoriRequest $request)
    {
        try {
            Kategori::create([
                'nama' => $request->nama
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);

        $view = [
            'data' => view('main.kategori.edit', compact('kategori'))->render()
        ];

        return response()->json($view);
    }

    public function update(KategoriRequest $request)
    {
        try {
            $kategori = Kategori::find($request->id);
            $kategori->update([
                'nama' => $request->nama,
                'status' => $request->status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
}
