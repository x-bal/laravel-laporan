<?php

use App\Karyawan;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email'    => 'admin@gmail.com',
            'password'    => bcrypt('admin'),
            'level' => 'A'
        ]);

        Karyawan::create([
            'nama' => "Admin",
            'jk' => 'L',
            'alamat' => "Jakarta",
            'pendidikan' => 'SMK',
            'nohp' => '08965778674',
            'user_id' => $user->id
        ]);
    }
}
