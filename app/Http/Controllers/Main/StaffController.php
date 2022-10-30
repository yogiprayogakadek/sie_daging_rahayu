<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class StaffController extends Controller
{
    public function index()
    {
        return view('main.staff.index');
    }

    public function render() 
    {
        $staff = Staff::all();
        $view = [
            'data' => view('main.staff.render')->with([
                'staff' => $staff
            ])->render()
        ];

        return response()->json($view);
    }

    public function create() 
    {
        $view = [
            'data' => view('main.staff.create')->render()
        ];

        return response()->json($view);
    }

    public function store(StaffRequest $request)
    {
        try {
            $userData = [
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => 'Staff',
                'status' => true
            ];

            if($request->hasFile('foto')) {
                //get filename with extension
                $filenamewithextension = $request->file('foto')->getClientOriginalName();

                //get file extension
                $extension = $request->file('foto')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->nama . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/images/users';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                $img = Image::make($request->file('foto')->getRealPath());
                $img->resize(512, 512);
                $img->save($save_path . '/' . $filenametostore);

                $userData['foto'] = $save_path . '/' . $filenametostore;
            }

            $user = User::create($userData);

            $data = [
                'user_id' => $user->id,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ];

            Staff::create($data);

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
        $staff = Staff::with('user')->where('id', $id)->first();
        
        $view = [
            'data' => view('main.staff.edit', compact('staff'))->render()
        ];

        return response()->json($view);
    }

    public function update(StaffRequest $request)
    {
        try {
            $user = User::find($request->user_id);
            $userData = [
                'username' => $request->username,
                'status' => $request->status,
                'status' => $request->status
                // 'password' => bcrypt($request->password),
            ];

            if($request->has('current_password') && $request->current_password != '') {
                if($request->new_password == '' || $request->confirmation_password == '') {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Password harus diisi',
                        'title' => 'Gagal',
                    ]);
                } else {
                    if(!Hash::check($request->current_password, $user->password)) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Password lama tidak sesuai',
                            'title' => 'Gagal'
                        ]);
                    } else {
                        $userData['password'] = Hash::make($request->new_password);
                    }
                }
            }

            if($request->hasFile('foto')) {
                unlink($user->foto);
                //get filename with extension
                $filenamewithextension = $request->file('foto')->getClientOriginalName();

                //get file extension
                $extension = $request->file('foto')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->nama . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/images/users';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                $img = Image::make($request->file('foto')->getRealPath());
                $img->resize(512, 512);
                $img->save($save_path . '/' . $filenametostore);

                $userData['foto'] = $save_path . '/' . $filenametostore;
            }

            $user->update($userData);

            $data = [
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ];

            Staff::where('user_id', $request->user_id)->update($data);

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
