<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HutangController extends Controller
{
    public function __construct()
    {
        // Create views directory if it doesn't exist
        $this->ensureViewsExist();
    }

    private function ensureViewsExist()
    {
        $viewsPath = resource_path('views/hutang');
        
        if (!File::exists($viewsPath)) {
            File::makeDirectory($viewsPath, 0755, true);
            $this->createViewFiles($viewsPath);
        }
    }

    private function createViewFiles($viewsPath)
    {
        // Create index.blade.php
        $indexView = $this->getIndexView();
        File::put($viewsPath . '/index.blade.php', $indexView);

        // Create create.blade.php
        $createView = $this->getCreateView();
        File::put($viewsPath . '/create.blade.php', $createView);

        // Create edit.blade.php
        $editView = $this->getEditView();
        File::put($viewsPath . '/edit.blade.php', $editView);

        // Create show.blade.php
        $showView = $this->getShowView();
        File::put($viewsPath . '/show.blade.php', $showView);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Hutang::query();

        // Filter by search (nama peminjam)
        if ($request->search) {
            $query->where('nama_peminjam', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $hutangs = $query->orderBy('created_at', 'desc')->get();

        return view('hutang.index', compact('hutangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hutang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'nomor_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'jumlah_hutang' => 'required|numeric|min:0',
            'tanggal_hutang' => 'required|date',
            'tanggal_jatuh_tempo' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        Hutang::create($validated);

        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hutang $hutang)
    {
        return view('hutang.show', compact('hutang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hutang $hutang)
    {
        return view('hutang.edit', compact('hutang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hutang $hutang)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'nomor_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'jumlah_hutang' => 'required|numeric|min:0',
            'jumlah_bayar' => 'required|numeric|min:0',
            'status' => 'required|in:belum_lunas,sebagian_lunas,lunas',
            'tanggal_hutang' => 'required|date',
            'tanggal_jatuh_tempo' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $hutang->update($validated);

        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hutang $hutang)
    {
        $hutang->delete();

        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil dihapus');
    }

    /**
     * Update payment status
     */
    public function bayar(Request $request, Hutang $hutang)
    {
        $validated = $request->validate([
            'jumlah_bayar_tambahan' => 'required|numeric|min:0',
        ]);

        $jumlah_bayar_baru = $hutang->jumlah_bayar + $validated['jumlah_bayar_tambahan'];
        
        // Update status
        if ($jumlah_bayar_baru >= $hutang->jumlah_hutang) {
            $status = 'lunas';
            $jumlah_bayar_baru = $hutang->jumlah_hutang;
        } elseif ($jumlah_bayar_baru > 0) {
            $status = 'sebagian_lunas';
        } else {
            $status = 'belum_lunas';
        }

        $hutang->update([
            'jumlah_bayar' => $jumlah_bayar_baru,
            'status' => $status,
        ]);

        return redirect()->route('hutang.show', $hutang)->with('success', 'Pembayaran hutang berhasil dicatat');
    }

    private function getIndexView()
    {
        return <<<'BLADE'
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
BLADE;
    }

    private function getCreateView()
    {
        return <<<'BLADE'
@extends('layouts.app')
@section('title', 'Tambah Hutang')
@section('page-title', 'Tambah Data Hutang')

@section('content')

<div class="max-w-2xl mx-auto bg-white rounded-2xl p-6" style="border:1px solid var(--border);">
    <form action="{{ route('hutang.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2" style="color:var(--ink);">Nama Peminjam <span class="text-red-500">*</span></label>
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
BLADE;
    }

    private function getEditView()
    {
        return <<<'BLADE'
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
BLADE;
    }

    private function getShowView()
    {
        return <<<'BLADE'
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
BLADE;
    }
}

