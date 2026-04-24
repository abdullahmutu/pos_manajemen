<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukAwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produks = [
            ['nama_produk' => 'Gula Pasir 1kg',       'kategori' => 'Sembako',    'harga_beli' => 13000, 'harga_jual' => 15000, 'stok' => 50,  'satuan' => 'kg'],
            ['nama_produk' => 'Minyak Goreng 1L',      'kategori' => 'Sembako',    'harga_beli' => 14000, 'harga_jual' => 16000, 'stok' => 30,  'satuan' => 'liter'],
            ['nama_produk' => 'Beras Premium 5kg',     'kategori' => 'Sembako',    'harga_beli' => 60000, 'harga_jual' => 68000, 'stok' => 20,  'satuan' => 'kg'],
            ['nama_produk' => 'Indomie Goreng',        'kategori' => 'Sembako',    'harga_beli' => 3000,  'harga_jual' => 3500,  'stok' => 100, 'satuan' => 'pcs'],
            ['nama_produk' => 'Aqua 600ml',            'kategori' => 'Minuman',    'harga_beli' => 2500,  'harga_jual' => 3500,  'stok' => 60,  'satuan' => 'pcs'],
            ['nama_produk' => 'Teh Botol Sosro',       'kategori' => 'Minuman',    'harga_beli' => 4000,  'harga_jual' => 5000,  'stok' => 48,  'satuan' => 'pcs'],
            ['nama_produk' => 'Chitato 68gr',          'kategori' => 'Snack',      'harga_beli' => 8000,  'harga_jual' => 10000, 'stok' => 24,  'satuan' => 'pcs'],
            ['nama_produk' => 'Sabun Lifebuoy',        'kategori' => 'Kebersihan', 'harga_beli' => 4000,  'harga_jual' => 5500,  'stok' => 36,  'satuan' => 'pcs'],
            ['nama_produk' => 'Pasta Gigi Pepsodent',  'kategori' => 'Kebersihan', 'harga_beli' => 9000,  'harga_jual' => 12000, 'stok' => 5,   'satuan' => 'pcs'],
            ['nama_produk' => 'Kopi Kapal Api',        'kategori' => 'Minuman',    'harga_beli' => 1500,  'harga_jual' => 2000,  'stok' => 3,   'satuan' => 'pcs'],
        ];

        foreach ($produks as $p) {
            Produk::create($p);
        }
    }
}
