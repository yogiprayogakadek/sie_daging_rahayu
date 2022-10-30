<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemasokRequest;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index()
    {
        return view('main.pemasok.index');
    }

    public function render() 
    {
        $pemasok = Pemasok::all();
        $view = [
            'data' => view('main.pemasok.render')->with([
                'pemasok' => $pemasok
            ])->render()
        ];

        return response()->json($view);
    }

    public function create() 
    {
        $view = [
            'data' => view('main.pemasok.create')->render()
        ];

        return response()->json($view);
    }

    public function store(PemasokRequest $request)
    {
        try {
            $data = [
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'status' => true,
            ];

            Pemasok::create($data);

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
        $pemasok = Pemasok::find($id);
        
        $view = [
            'data' => view('main.pemasok.edit', compact('pemasok'))->render()
        ];

        return response()->json($view);
    }

    public function update(PemasokRequest $request)
    {
        try {
            $pemasok = Pemasok::find($request->id);
            $data = [
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'status' => $request->status,
            ];
            
            $pemasok->update($data);

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

