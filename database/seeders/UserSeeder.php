<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'nim' => '12345678',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ];

        $admin = User::firstOrCreate(['email' => $data['email']], $data);
        $admin->assignRole('admin');

        $data = [
            'name' => 'user',
            'nim' => '12345679',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678')
        ];

        $user = User::firstOrCreate(['email' => $data['email']], $data);
        $user->assignRole('user');

        $data = [
            'name' => 'Organisasi',
            'nim' => '12345679',
            'email' => 'organisasi@gmail.com',
            'password' => Hash::make('12345678')
        ];

        $organisasi = User::firstOrCreate(['email' => $data['email']], $data);
        $organisasi->assignRole('organisasi');
    }
}
