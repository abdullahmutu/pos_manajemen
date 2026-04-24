<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id', 'no_transaksi', 'total_harga',
        'bayar', 'kembalian', 'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public static function generateNoTransaksi(): string
    {
        $prefix = 'TRX-' . date('Ymd') . '-';
        $last = static::where('no_transaksi', 'like', $prefix . '%')
            ->orderByDesc('id')->first();
        $number = $last ? (int) substr($last->no_transaksi, -4) + 1 : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month);
    }
}
