@extends('layouts.app')
@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')

    <a href="{{ route('produk.index') }}"
    class="inline-flex items-center gap-1.5 text-sm mb-5 hover:underline"
    style="color:var(--slate);"
    >
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Produk
    </a>

    <div class="max-w-2xl mx-auto">

        <x-table-card title="Edit Produk">

            {{-- Header tambahan --}}
            <div class="px-6 py-4 border-b flex items-start justify-between"
                style="border-color:var(--border); background:var(--cream);">
                <div>
                    <p class="text-sm" style="color:var(--slate);">
                        {{ $produk->nama_produk }}
                    </p>
                </div>
                <span class="text-xs px-2.5 py-1 rounded-full font-medium"
                    style="background:var(--pine-light); color:var(--pine);"
                    >
                    Stok: {{ $produk->stok }}
                </span>
            </div>

            {{-- Form --}}
            <form action="{{ route('produk.update', $produk) }}" method="POST" class="p-6">
                @csrf 
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Nama Produk -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold mb-1.5 uppercase"
                            style="color:var(--slate);"
                            >
                            Nama Produk
                        </label>
                        <input type="text" name="nama_produk"
                            class="w-full border rounded-xl px-4 py-2.5 text-sm"
                            style="border-color:var(--border);"
                            value="{{ old('nama_produk', $produk->nama_produk) }}"
                        >
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 uppercase"
                            style="color:var(--slate);"
                            >
                            Kategori
                        </label>
                        <input type="text" name="kategori"
                            class="w-full border rounded-xl px-4 py-2.5 text-sm"
                            style="border-color:var(--border);"
                            value="{{ old('kategori', $produk->kategori) }}"
                        >
                    </div>

                    <!-- Satuan -->
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 uppercase"
                            style="color:var(--slate);"
                            >
                            Satuan
                        </label>

                        <select name="satuan"
                                class="w-full border rounded-xl px-4 py-2.5 text-sm"
                                style="border-color:var(--border);"
                            >
                            @foreach(['pcs','kg','liter','pack','dus'] as $s)
                                <option value="{{ $s }}" {{ $produk->satuan == $s ? 'selected' : '' }}>
                                    {{ $s }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga Beli -->
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 uppercase"
                            style="color:var(--slate);"
                            >
                            Harga Beli
                        </label>
                        <input type="number" name="harga_beli"
                            class="w-full border rounded-xl px-4 py-2.5 text-sm"
                            style="border-color:var(--border);"
                            value="{{ old('harga_beli', $produk->harga_beli) }}"
                        >
                    </div>

                    <!-- Harga Jual -->
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 uppercase"
                            style="color:var(--slate);"
                            >
                            Harga Jual
                        </label>
                        <input type="number" name="harga_jual"
                            class="w-full border rounded-xl px-4 py-2.5 text-sm"
                            style="border-color:var(--border);"
                            value="{{ old('harga_jual', $produk->harga_jual) }}"
                        >
                    </div>

                    <!-- Stok -->
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 uppercase"
                            style="color:var(--slate);"
                            >
                            Stok
                        </label>
                        <input type="number" name="stok"
                            class="w-full border rounded-xl px-4 py-2.5 text-sm"
                            style="border-color:var(--border);"
                            value="{{ old('stok', $produk->stok) }}"
                        >
                    </div>

                    <!-- Keterangan -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold mb-1.5 uppercase"
                            style="color:var(--slate);"
                            >
                            Keterangan
                        </label>
                        <textarea name="keterangan" rows="3"
                                class="w-full border rounded-xl px-4 py-2.5 text-sm"
                                style="border-color:var(--border);"
                            >
                            {{ old('keterangan', $produk->keterangan) }}
                        </textarea>
                    </div>

                </div>

                <!-- Action -->
                <div class="mt-5 pt-5 border-t flex justify-end gap-3"
                    style="border-color:var(--border);">

                    <!-- button batal -->
                    <x-button href="{{ route('produk.index') }}">
                        Batal
                    </x-button>

                    <!-- button simpan -->
                    <x-button type="submit" style="background:var(--pine); color:#fff;">
                        Update Produk
                    </x-button>
                </div>

            </form>

        </x-table-card>

    </div>

@endsection