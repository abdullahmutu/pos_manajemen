@extends('layouts.app')
@section('title', 'Tambah Hutang')
@section('page-title', 'Tambah Data Hutang')

@section('content')

<div class="max-w-2xl mx-auto bg-white rounded-2xl p-6" style="border:1px solid var(--border);">
    <form action="{{ route('hutang.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Nama<span class="text-red-500">*</span></label>
            <input type="text" name="nama_peminjam" class="w-full px-3 py-2 border rounded-lg text-sm @error('nama_peminjam') border-red-500 @else border @endif" style="border-color:var(--border);" value="{{ old('nama_peminjam') }}" required>
            @error('nama_peminjam')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Nomor HP</label>
            <input type="text" name="nomor_hp" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" value="{{ old('nomor_hp') }}">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Alamat</label>
            <textarea name="alamat" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" rows="3">{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Jumlah Hutang <span class="text-red-500">*</span></label>
            <input type="number" name="jumlah_hutang" class="w-full px-3 py-2 border rounded-lg text-sm @error('jumlah_hutang') border-red-500 @else border @endif" style="border-color:var(--border);" value="{{ old('jumlah_hutang') }}" step="0.01" required>
            @error('jumlah_hutang')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Tanggal Hutang <span class="text-red-500">*</span></label>
            <input type="date" name="tanggal_hutang" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" value="{{ old('tanggal_hutang', date('Y-m-d')) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Tanggal Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" value="{{ old('tanggal_jatuh_tempo') }}">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Keterangan</label>
            <textarea name="keterangan" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);" rows="3">{{ old('keterangan') }}</textarea>
        </div>

        <div class="flex gap-3">
            <x-button type="submit">Simpan</x-button>
            <x-button variant="outline" href="{{ route('hutang.index') }}">Batal</x-button>
        </div>
    </form>
</div>

@endsection