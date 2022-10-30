<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'Owner',
            'password' => bcrypt('12345678'),
            'role' => 'Owner',
            'foto' => 'assets/upload/images/users/default.png',
        ]);

        Owner::create([
            'user_id' => $user->id,
            'nama' => 'Owner',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998/12/15',
            'jenis_kelamin' => true,
            'telepon' => '082237188923',
            'alamat' => 'Jl. Palapa XIV Gg. Ikan Sardin No.9'
        ]);
    }
}
