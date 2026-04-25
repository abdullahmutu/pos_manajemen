<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    protected $table = 'hutangs';
    protected $fillable = [
        'nama_peminjam',
        'nomor_hp',
        'alamat',
        'jumlah_hutang',
        'jumlah_bayar',
        'status',
        'tanggal_hutang',
        'tanggal_jatuh_tempo',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_hutang' => 'date',
        'tanggal_jatuh_tempo' => 'date',
        'jumlah_hutang' => 'decimal:2',
        'jumlah_bayar' => 'decimal:2',
    ];

    public function getSisaHutangAttribute()
    {
        return $this->jumlah_hutang - $this->jumlah_bayar;
    }
}
