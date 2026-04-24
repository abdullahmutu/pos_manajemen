@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')

    <a href="{{ route('produk.index') }}"
    class="inline-flex items-center gap-1.5 text-sm mb-5 hover:underline"
    style="color:var(--slate);">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Produk
    </a>

    <div class="max-w-2xl mx-auto">

        <div class="bg-white rounded-2xl overflow-hidden" style="border:1px solid var(--border);">

            <div class="px-6 py-5 border-b" style="border-color:var(--border); background:var(--cream);">
                <h2 class="serif text-lg">Produk Baru</h2>
                <p class="text-sm mt-0.5" style="color:var(--slate);">Isi detail produk dengan lengkap</p>
            </div>

            <form action="{{ route('produk.store') }}" method="POST" class="p-6">
                
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Nama Produk -->
                    <div class="sm:col-span-2">
                        <x-input 
                            label="Nama Produk"
                            name="nama_produk"
                            placeholder="cth: Minyak Goreng Tropical 1L"
                        />
                    </div>

                    <!-- Kategori -->
                    <x-input 
                        label="Kategori"
                        name="kategori"
                        placeholder="cth: Sembako"
                    />

                    <!-- Satuan -->
                    <x-select
                        name="satuan"
                        :options="['pcs','kg','liter','pack','dus']"
                        selected="{{ old('satuan') }}"
                    />

                    <!-- Harga Beli -->
                    <x-input 
                        label="Harga Beli (Rp)"
                        name="harga_beli"
                        type="number"
                        placeholder="0"
                    />

                    <!-- Harga Jual -->
                    <x-input 
                        label="Harga Jual (Rp)"
                        name="harga_jual"
                        type="number"
                        placeholder="0"
                    />

                    <!-- Stok -->
                    <x-input 
                        label="Stok Awal"
                        name="stok"
                        type="number"
                        placeholder="0"
                    />

                    <!-- Keterangan -->
                    <div class="sm:col-span-2">
                        <x-textarea 
                            label="Keterangan (opsional)"
                            name="keterangan"
                            placeholder="Deskripsi tambahan..."
                        />
                    </div>

                </div>

                <!-- action -->
                <div class="mt-5 pt-5 border-t flex justify-end gap-3" style="border-color:var(--border);">

                    <!-- button batal -->
                    <x-button variant="outline" href="{{ route('produk.index') }}">
                        Batal
                    </x-button>

                    <!-- button simpan -->
                    <x-button type="submit">
                        Simpan Produk
                    </x-button>

                </div>

            </form>
        </div>
    </div>

@endsection