@extends('layouts.app')
@section('title', 'Hutang')
@section('page-title', 'Manajemen Hutang')

@section('content')

    <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
        <div class="text-sm" style="color:var(--slate);">
            <span class="font-semibold" style="color:var(--ink);">{{ count($hutangs) }}</span>
            hutang terdaftar
        </div>

        @auth
            @if(auth()->user()->role === 'admin')
            <x-button href="{{ route('hutang.create') }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Hutang
            </x-button>
            @endif
        @endauth
    </div>

    <div class="bg-white rounded-2xl p-4 mb-5" style="border:1px solid var(--border);">
        <form action="{{ route('hutang.index') }}" method="GET" class="flex flex-wrap gap-2 items-center">
            <div class="flex-1 min-w-45">
                <x-input-search name="search" :value="request('search')" placeholder="Cari nama peminjam..." />
            </div>
            <select name="status" class="px-3 py-2 border rounded-lg text-sm" style="border-color:var(--border);">
                <option value="">Semua Status</option>
                <option value="belum_lunas" {{ request('status') === 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="sebagian_lunas" {{ request('status') === 'sebagian_lunas' ? 'selected' : '' }}>Sebagian Lunas</option>
                <option value="lunas" {{ request('status') === 'lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
            <x-button type="submit">Cari</x-button>
            @if(request()->hasAny(['search','status']))
            <x-button variant="outline" href="{{ route('hutang.index') }}">Reset</x-button>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-2xl overflow-hidden" style="border:1px solid var(--border);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead style="background-color:var(--canvas-secondary);">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold" style="color:var(--slate);">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold" style="color:var(--slate);">Nama Peminjam</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold" style="color:var(--slate);">Nomor HP</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold" style="color:var(--slate);">Jumlah Hutang</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold" style="color:var(--slate);">Sudah Dibayar</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold" style="color:var(--slate);">Sisa Hutang</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold" style="color:var(--slate);">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold" style="color:var(--slate);">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hutangs as $index => $hutang)
                    <tr style="border-top:1px solid var(--border);">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm font-medium" style="color:var(--ink);">{{ $hutang->nama_peminjam }}</td>
                        <td class="px-4 py-3 text-sm">{{ $hutang->nomor_hp ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-right">Rp {{ number_format($hutang->jumlah_hutang, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-sm text-right">Rp {{ number_format($hutang->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-sm text-right font-medium">Rp {{ number_format($hutang->sisa_hutang, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-center text-sm">
                            @if($hutang->status === 'belum_lunas')
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-100" style="color:#dc2626;">Belum Lunas</span>
                            @elseif($hutang->status === 'sebagian_lunas')
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100" style="color:#ea580c;">Sebagian Lunas</span>
                            @else
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100" style="color:#059669;">Lunas</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center text-sm">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('hutang.show', $hutang) }}" class="text-blue-500 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </a>
                                <a href="{{ route('hutang.edit', $hutang) }}" class="text-yellow-500 hover:text-yellow-700">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('hutang.destroy', $hutang) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr style="border-top:1px solid var(--border);">
                        <td colspan="8" class="px-4 py-8 text-center text-sm" style="color:var(--slate);">Tidak ada data hutang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection