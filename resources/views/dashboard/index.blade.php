@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ── STAT CARDS ── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    <x-stat-card
        label="Total Produk"
        :value="$totalProduk"
        sub="item terdaftar"
        bg="#EAF2EC"
        accent="#1A3D2B"
        icon="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
    />

    <x-stat-card
        label="Transaksi Hari Ini"
        :value="$transaksiHariIni_count"
        :sub="'Rp '.number_format($transaksiHariIni,0,',','.')"
        bg="#EEF2FF"
        accent="#3730A3"
        icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
    />

    <x-stat-card
        label="Penjualan Bulan Ini"
        :value="'Rp '.number_format($transaksiTotal,0,',','.')"
        sub="pendapatan bulan ini"
        bg="#FDF3DC"
        accent="#92400E"
        icon="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
    />

    <x-stat-card
        label="Stok Menipis"
        :value="$stokMenipis"
        sub="produk perlu restock"
        bg="#FEF2F2"
        accent="#991B1B"
        icon="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3"
    />

</div>

{{-- ── TABLES ── --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- Transaksi Terbaru --}}
    <x-table-card 
        title="Transaksi Terbaru" 
        :link="route('transaksi.index')"
        class="lg:col-span-2"
    >
        <table class="w-full text-sm">
            <thead>
            <tr style="background:var(--cream);">
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase"
                    style="color:var(--slate);">No Transaksi</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase"
                    style="color:var(--slate);">Kasir</th>
                <th class="px-6 py-3 text-right text-xs font-semibold uppercase"
                    style="color:var(--slate);">Total</th>
            </tr>
            </thead>

            <tbody class="divide-y" style="border-color:var(--border);">
            @foreach($transaksiTerbaru as $trx)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-3.5 font-semibold text-sm" style="color:var(--pine);">
                    <a href="{{ route('transaksi.show', $trx) }}" class="hover:underline">
                        {{ $trx->no_transaksi }}
                    </a>
                </td>
                <td class="px-6 py-3.5 text-sm" style="color:var(--slate);">
                    {{ optional($trx->user)->name ?? '-' }}
                </td>
                <td class="px-6 py-3.5 text-sm font-semibold text-right">
                    Rp {{ number_format($trx->total_harga,0,',','.') }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </x-table-card>

    {{-- Stok Menipis --}}
    <x-table-card 
        title="⚠ Stok Menipis"
        class="lg:col-span-1"
    >

        <div class="divide-y" style="border-color:var(--border);">
        @forelse($produkMenipis as $p)
            <div class="flex justify-between items-center px-5 py-3.5">
                <span class="text-sm font-medium">{{ $p->nama_produk }}</span>
                <span class="text-xs font-bold px-2.5 py-1 rounded-full"
                    style="background:#FEF2F2; color:#991B1B;">
                    {{ $p->stok }} sisa
                </span>
            </div>
        @empty
            <div class="px-5 py-6 text-center text-sm" style="color:var(--slate);">
                Stok aman 🎉
            </div>
        @endforelse
        </div>

    </x-table-card>

</div>
@endsection