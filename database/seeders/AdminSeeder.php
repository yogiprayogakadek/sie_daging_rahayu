<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => bcrypt('12345678'),
            'role' => 'Admin',
            'foto' => 'assets/upload/images/users/default.png',
        ]);

        Admin::create([
            'user_id' => $user->id,
            'nama' => 'Administrator',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998/12/15',
            'jenis_kelamin' => true,
            'telepon' => '082237188923',
            'alamat' => 'Jl. Palapa XIV Gg. Ikan Sardin No.9',
            // 'status' => true
        ]);
    }
}
