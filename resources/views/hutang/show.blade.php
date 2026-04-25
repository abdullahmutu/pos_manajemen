@extends('layouts.app')
@section('title', 'Detail Hutang')
@section('page-title', 'Detail Data Hutang')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl p-6 mb-6" style="border:1px solid var(--border);">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-xs font-semibold" style="color:var(--slate);">Nama Peminjam</p>
                <p class="text-base font-semibold mt-1" style="color:var(--ink);">{{ $hutang->nama_peminjam }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold" style="color:var(--slate);">Nomor HP</p>
                <p class="text-base font-semibold mt-1" style="color:var(--ink);">{{ $hutang->nomor_hp ?? '-' }}</p>
            </div>
            <div class="col-span-2">
                <p class="text-xs font-semibold" style="color:var(--slate);">Alamat</p>
                <p class="text-base font-semibold mt-1" style="color:var(--ink);">{{ $hutang->alamat ?? '-' }}</p>
            </div>
        </div>

        <hr style="border-color:var(--border);" class="my-6">

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-50 rounded-lg p-4" style="background-color:var(--canvas-secondary);">
                <p class="text-xs font-semibold" style="color:var(--slate);">Total Hutang</p>
                <p class="text-lg font-bold mt-2" style="color:var(--ink);">Rp {{ number_format($hutang->jumlah_hutang, 0, ',', '.') }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4" style="background-color:var(--canvas-secondary);">
                <p class="text-xs font-semibold" style="color:var(--slate);">Sudah Dibayar</p>
                <p class="text-lg font-bold mt-2" style="color:var(--ink);">Rp {{ number_format($hutang->jumlah_bayar, 0, ',', '.') }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4" style="background-color:var(--canvas-secondary);">
                <p class="text-xs font-semibold" style="color:var(--slate);">Sisa Hutang</p>
                <p class="text-lg font-bold mt-2" style="color:var(--ink);">Rp {{ number_format($hutang->sisa_hutang, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-xs font-semibold" style="color:var(--slate);">Status</p>
                <div class="mt-2">
                    @if($hutang->status === 'belum_lunas')
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100" style="color:#dc2626;">Belum Lunas</span>
                    @elseif($hutang->status === 'sebagian_lunas')
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100" style="color:#ea580c;">Sebagian Lunas</span>
                    @else
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100" style="color:#059669;">Lunas</span>
                    @endif
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold" style="color:var(--slate);">Tanggal Hutang</p>
                <p class="text-base font-semibold mt-1" style="color:var(--ink);">{{ $hutang->tanggal_hutang->format('d/m/Y') }}</p>
            </div>
        </div>

        @if($hutang->tanggal_jatuh_tempo)
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-xs font-semibold" style="color:var(--slate);">Tanggal Jatuh Tempo</p>
                <p class="text-base font-semibold mt-1" style="color:var(--ink);">{{ $hutang->tanggal_jatuh_tempo->format('d/m/Y') }}</p>
            </div>
        </div>
        @endif

        @if($hutang->keterangan)
        <div class="mb-6">
            <p class="text-xs font-semibold" style="color:var(--slate);">Keterangan</p>
            <p class="text-base mt-1" style="color:var(--ink);">{{ $hutang->keterangan }}</p>
        </div>
        @endif
    </div>

    <div class="flex gap-3 mb-6">
        <x-button href="{{ route('hutang.edit', $hutang) }}">Edit</x-button>
        <form action="{{ route('hutang.destroy', $hutang) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
            @csrf
            @method('DELETE')
            <x-button variant="outline" type="submit" style="color:#dc2626;">Hapus</x-button>
        </form>
        <x-button variant="outline" href="{{ route('hutang.index') }}">Kembali</x-button>
    </div>

    @if($hutang->status !== 'lunas')
    <div class="bg-white rounded-2xl p-6" style="border:1px solid var(--border);">
        <h3 class="text-lg font-semibold mb-4" style="color:var(--ink);">Catat Pembayaran</h3>
        
        <form action="{{ route('hutang.bayar', $hutang) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Jumlah Pembayaran <span class="text-red-500">*</span></label>
                <input type="number" name="jumlah_bayar_tambahan" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" placeholder="Masukkan jumlah pembayaran" step="0.01" required>
            </div>

            <x-button type="submit">Catat Pembayaran</x-button>
        </form>
    </div>
    @endif
</div>

@endsection