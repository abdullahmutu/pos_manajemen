@extends('layouts.app')
@section('title', 'Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')

    {{-- HEADER --}}
    <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
        <div class="text-sm" style="color:var(--slate);">
            Total hari ini:
            <span class="font-bold text-base" style="color:var(--pine);">
                Rp {{ number_format($totalHari,0,',','.') }}
            </span>
        </div>

        <x-button href="{{ route('transaksi.create') }}" variant="outline" class="text-xs">
            + Buka Kasir
        </x-button>
    </div>

    {{-- FILTER --}}
    <x-table-card title="Filter Transaksi" class="mb-5">

        <form action="{{ route('transaksi.index') }}" method="GET"
            class="flex flex-wrap gap-2 items-center p-4">

            <x-input 
                type="date"
                name="tanggal"
                value="{{ request('tanggal') }}"
            />

            <x-button type="submit">
                Filter
            </x-button>

            @if(request('tanggal'))
                <x-button href="{{ route('transaksi.index') }}" variant="outline">
                    Reset
                </x-button>
            @endif

        </form>

    </x-table-card>

    {{-- TABLE --}}
    <x-table-card title="Daftar Transaksi">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">
                <thead>
                    <tr style="background:var(--cream); border-bottom:1px solid var(--border);">
                        <th class="px-5 py-3 text-left text-xs font-semibold">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold">Kasir</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold">Total</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold">Bayar</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold">Kembalian</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold">Waktu</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($transaksis as $trx)
                    <tr class="hover:bg-gray-50">

                        <td class="px-5 py-4 font-semibold">
                            <a href="{{ route('transaksi.show', $trx) }}" class="hover:underline">
                                {{ $trx->no_transaksi }}
                            </a>
                        </td>

                        <td class="px-5 py-4">
                            {{ optional($trx->user)->name ?? '-' }}
                        </td>

                        <td class="px-5 py-4 font-semibold">
                            Rp {{ number_format($trx->total_harga,0,',','.') }}
                        </td>

                        <td class="px-5 py-4">
                            Rp {{ number_format($trx->bayar,0,',','.') }}
                        </td>

                        <td class="px-5 py-4 font-medium" style="color:var(--pine);">
                            Rp {{ number_format($trx->kembalian,0,',','.') }}
                        </td>

                        <td class="px-5 py-4 text-xs">
                            {{ $trx->created_at->format('d/m H:i') }}
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex gap-2">

                                <x-button 
                                    href="{{ route('transaksi.show', $trx) }}"
                                    size="sm"
                                    variant="outline">
                                    Detail
                                </x-button>

                                <form action="{{ route('transaksi.destroy', $trx) }}" method="POST">
                                    @csrf @method('DELETE')

                                    <x-button 
                                        type="submit"
                                        size="sm"
                                        variant="danger"
                                        onclick="return confirm('Hapus transaksi ini?')">
                                        Hapus
                                    </x-button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-16 text-sm">
                            <div class="text-3xl mb-2">🧾</div>
                            Belum ada transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </x-table-card>

@endsection