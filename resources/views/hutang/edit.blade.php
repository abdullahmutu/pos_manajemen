@extends('layouts.app')
@section('title', 'Edit Hutang')
@section('page-title', 'Edit Data Hutang')

@section('content')

<div class="max-w-2xl mx-auto bg-white rounded-2xl p-6" style="border:1px solid var(--border);">
    <form action="{{ route('hutang.update', $hutang) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Nama Peminjam <span class="text-red-500">*</span></label>
            <input type="text" name="nama_peminjam" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" value="{{ old('nama_peminjam', $hutang->nama_peminjam) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Nomor HP</label>
            <input type="text" name="nomor_hp" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" value="{{ old('nomor_hp', $hutang->nomor_hp) }}">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Alamat</label>
            <textarea name="alamat" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" rows="3">{{ old('alamat', $hutang->alamat) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Jumlah Hutang <span class="text-red-500">*</span></label>
            <input type="number" name="jumlah_hutang" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" value="{{ old('jumlah_hutang', $hutang->jumlah_hutang) }}" step="0.01" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Jumlah Sudah Dibayar <span class="text-red-500">*</span></label>
            <input type="number" name="jumlah_bayar" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" value="{{ old('jumlah_bayar', $hutang->jumlah_bayar) }}" step="0.01" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Status <span class="text-red-500">*</span></label>
            <select name="status" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" required>
                <option value="belum_lunas" {{ old('status', $hutang->status) === 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="sebagian_lunas" {{ old('status', $hutang->status) === 'sebagian_lunas' ? 'selected' : '' }}>Sebagian Lunas</option>
                <option value="lunas" {{ old('status', $hutang->status) === 'lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Tanggal Hutang <span class="text-red-500">*</span></label>
            <input type="date" name="tanggal_hutang" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" value="{{ old('tanggal_hutang', $hutang->tanggal_hutang->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Tanggal Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" value="{{ old('tanggal_jatuh_tempo', $hutang->tanggal_jatuh_tempo?->format('Y-m-d')) }}">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Keterangan</label>
            <textarea name="keterangan" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" rows="3">{{ old('keterangan', $hutang->keterangan) }}</textarea>
        </div>

        <div class="flex gap-3">
            <x-button type="submit">Update</x-button>
            <x-button variant="outline" href="{{ route('hutang.index') }}">Batal</x-button>
        </div>
    </form>
</div>

@endsection