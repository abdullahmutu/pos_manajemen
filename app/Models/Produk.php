<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama_produk', 'kategori', 'harga_beli',
        'harga_jual', 'stok', 'satuan', 'keterangan'
    ];

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function stokMenipis(): bool
    {
        return $this->stok <= 5;
    }

    public function getKeuntunganAttribute(): float
    {
        return $this->harga_jual - $this->harga_beli;
    }
}
