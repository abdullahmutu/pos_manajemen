@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('page-title', 'Struk Transaksi')

@section('content')

    <div class="flex gap-2 mb-5">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-1.5 text-sm border px-4 py-2.5 rounded-xl hover:bg-gray-50 transition-colors"
            style="border-color:var(--border);">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
        </a>
        <button onclick="window.print()"
                class="inline-flex items-center gap-1.5 text-sm px-4 py-2.5 rounded-xl font-semibold hover:opacity-90"
                style="background:var(--ink); color:#fff;">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Print Struk
        </button>
    </div>

    <div class="max-w-md mx-auto">
        <x-table-card title="">

            {{-- Header struk --}}
            <div class="px-6 py-6 text-center border-b" style="border-color:var(--border); background:var(--pine);">
                <div class="text-4xl mb-2">🏪</div>
                <h1 class="serif text-2xl text-white">TokoKu</h1>
                <p class="text-xs mt-1" style="color:rgba(255,255,255,0.55);">Struk Penjualan</p>
            </div>

            {{-- Info transaksi --}}
            <div class="px-6 py-4 border-b space-y-2.5" style="border-color:var(--border); background:var(--cream);">
                <div class="flex justify-between text-sm">
                    <span style="color:var(--slate);">No. Transaksi</span>
                    <span class="font-semibold">{{ $transaksi->no_transaksi }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span style="color:var(--slate);">Kasir</span>
                    <span>{{ $transaksi->user->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span style="color:var(--slate);">Tanggal</span>
                    <span>{{ $transaksi->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            {{-- Detail item --}}
            <div class="px-6 py-4 space-y-3 border-b" style="border-color:var(--border);">
                <div class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:var(--slate);">
                    Item Pembelian
                </div>
                @foreach($transaksi->details as $d)
                <div class="flex justify-between items-start gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium truncate">
                            {{ optional($d->produk)->nama_produk ?? 'Produk dihapus' }}
                        </div>
                        <div class="text-xs mt-0.5" style="color:var(--slate);">
                            {{ $d->jumlah }} × Rp {{ number_format($d->harga_satuan,0,',','.') }}
                        </div>
                    </div>
                    <div class="text-sm font-semibold shrink-0">
                        Rp {{ number_format($d->subtotal,0,',','.') }}
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Total --}}
            <div class="px-6 py-5 space-y-2.5">

                <div class="flex justify-between text-sm" style="color:var(--slate);">
                    <span>Bayar</span>
                    <span>Rp {{ number_format($transaksi->bayar,0,',','.') }}</span>
                </div>

                <div class="flex justify-between text-sm" style="color:var(--slate);">
                    <span>Kembalian</span>
                    <span class="font-semibold" style="color:var(--ink);">
                        Rp {{ number_format($transaksi->kembalian,0,',','.') }}
                    </span>
                </div>

                <div class="flex justify-between items-center pt-3 mt-3 border-t"
                    style="border-color:var(--border);">
                    <span class="font-bold text-base">Total</span>
                    <span class="serif text-xl font-bold" style="color:var(--pine);">
                        Rp {{ number_format($transaksi->total_harga,0,',','.') }}
                    </span>
                </div>
            </div>

            @if($transaksi->catatan)
            <div class="mx-6 mb-5 px-4 py-3 rounded-xl text-sm" style="background:var(--cream); color:var(--slate);">
                {{ $transaksi->catatan }}
            </div>
            @endif

            <div class="text-center py-5 border-t text-xs" style="border-color:var(--border); color:var(--slate);">
                Terima kasih telah berbelanja 🙏
            </div>

        </x-table-card>
    </div>

@endsection