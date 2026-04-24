<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk    = Produk::count();
        $stokMenipis    = Produk::where('stok', '<=', 5)->count();
        $totalUser      = User::count();

        $transaksiHariIni = Transaksi::whereDate('created_at', today())->sum('total_harga');
        $transaksiHariIni_count = Transaksi::whereDate('created_at', today())->count();
        $transaksiTotal = Transaksi::thisMonth()->sum('total_harga');

        $produkMenipis  = Produk::where('stok', '<=', 5)->orderBy('stok')->take(5)->get();
        $transaksiTerbaru = Transaksi::with('user')->orderByDesc('created_at')->take(5)->get();

        return view('dashboard.index', compact(
            'totalProduk', 'stokMenipis', 'totalUser',
            'transaksiHariIni', 'transaksiHariIni_count',
            'transaksiTotal', 'produkMenipis', 'transaksiTerbaru'
        ));
    }
}
