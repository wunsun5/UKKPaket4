<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'level' => 'admin',
        ]);
        \App\Models\User::factory()->create([
            'username' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('12345678'),
            'level' => 'petugas',
        ]);
        \App\Models\Product::factory()->create([
            'nama_produk' => 'Taro',
            'harga' => 35000,
            'stok' => 20,
        ]);
        \App\Models\Product::factory()->create([
            'nama_produk' => 'Chitato',
            'harga' => 15000,
            'stok' => 20,
        ]);

        \App\Models\Customer::factory()->create(
            [
                'nama_pelanggan' => 'Wunsun',
                'alamat' => 'Jl. Terubuk No. 70',
                'no_telp' => '081285388658',
            ]
        );
    }
}
