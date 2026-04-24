@extends('layouts.app')
@section('title', 'Produk')
@section('page-title', 'Manajemen Produk')

@section('content')

    {{-- Header --}}
    <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
        <div class="text-sm" style="color:var(--slate);">
            <span class="font-semibold" style="color:var(--ink);">{{ $produks->total() }}</span>
            produk terdaftar
        </div>

        <!-- button tambah produk -->
        @auth
            @if(auth()->user()->role === 'admin')
            <x-button href="{{ route('produk.create') }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Produk
            </x-button>
            @endif
        @endauth
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-2xl p-4 mb-5" style="border:1px solid var(--border);">
        <form id="formFilter" action="{{ route('produk.index') }}" method="GET"
        class="flex flex-wrap gap-2 items-center">

            <!-- Search -->
            <div class="flex-1 min-w-45">
                <x-input-search
                    name="search"
                    :value="request('search')"
                    placeholder="Cari nama / kategori..."
                />
            </div>

            <!-- kategori -->
            <x-select
                name="kategori"
                :options="$kategoris"
                :selected="request('kategori')"
                placeholder="Semua Kategori"
            />

            <!-- button cari -->
            <x-button type="submit">
                Cari
            </x-button>

            <!-- button reset -->
            @if(request()->hasAny(['search','kategori']))
            <x-button variant="outline" href="{{ route('produk.index') }}">
                Reset
            </x-button>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <x-table-card title="Data Produk">

        <div id="produkTable">
            <table class="w-full text-sm">
                <!-- nama kategori -->
                <thead>
                    <tr style="background:var(--cream); border-bottom:1px solid var(--border);">
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase">#</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase">Produk</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase">Kategori</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase">Harga Beli</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase">Harga Jual</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase">Stok</th>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase">Aksi</th>
                            @endif
                        @endauth
                    </tr>
                </thead>

                <!-- isi konten -->
                <tbody class="divide-y">

                    @forelse($produks as $i => $p)
                    <tr class="hover:bg-gray-50/60 transition-colors">

                        <td class="px-5 py-4 text-xs">
                            {{ $produks->firstItem() + $i }}
                        </td>

                        <td class="px-5 py-4">
                            <div class="font-semibold text-sm">{{ $p->nama_produk }}</div>
                            <div class="text-xs mt-0.5" style="color:var(--slate);">{{ $p->satuan }}</div>
                        </td>

                        <td class="px-5 py-4">
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full"
                                style="background:var(--pine-light); color:var(--pine);">
                                {{ $p->kategori }}
                            </span>
                        </td>

                        <td class="px-5 py-4 text-sm">
                            Rp {{ number_format($p->harga_beli,0,',','.') }}
                        </td>

                        <td class="px-5 py-4 text-sm font-semibold">
                            Rp {{ number_format($p->harga_jual,0,',','.') }}
                        </td>

                        <td class="px-5 py-4">
                            @if($p->stok == 0)
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                                    style="background:#FEF2F2; color:#991B1B;">Habis</span>
                            @elseif($p->stok <= 5)
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                                    style="background:#FFFBEB; color:#92400E;">{{ $p->stok }}</span>
                            @else
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                                    style="background:var(--pine-light); color:var(--pine);">{{ $p->stok }}</span>
                            @endif
                        </td>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('produk.edit', $p) }}"
                                        class="text-xs font-semibold hover:underline"
                                        style="color:var(--pine);">
                                            Edit
                                        </a>

                                        <form action="{{ route('produk.destroy', $p) }}" method="POST"
                                            onsubmit="return confirm('Hapus {{ $p->nama_produk }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="text-xs font-semibold hover:underline"
                                                    style="color:#DC2626;">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endauth

                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-16 text-sm" style="color:var(--slate);">
                            <div class="text-3xl mb-3">📦</div>
                            Belum ada produk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($produks->hasPages())
        <div class="px-5 py-4 border-t" style="border-color:var(--border);">
            {{ $produks->links() }}
        </div>
        @endif

    </x-table-card>

    <script>
    let timeout = null;

    function autoSubmitSearch() {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            const form = document.getElementById('formFilter');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();

            fetch(form.action + '?' + params, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {
                // ambil hanya bagian tabel
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const newTable = doc.querySelector('#produkTable');
                document.querySelector('#produkTable').innerHTML = newTable.innerHTML;
            });
        }, 400);
    }
    </script>
    
@endsection