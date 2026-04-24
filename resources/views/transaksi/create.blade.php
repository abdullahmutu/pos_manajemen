@extends('layouts.app')
@section('title', 'Kasir')
@section('page-title', 'Kasir POS')

@section('content')

    <form action="{{ route('transaksi.store') }}" method="POST" id="formTrx" onsubmit="return validateForm()">
        @csrf

        <!-- Hidden inputs untuk item keranjang — di dalam <form> -->
        <div id="hiddenInputs"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4" style="min-height:calc(100vh - 160px);">

            {{-- ── KOLOM 1: Daftar Produk ── --}}
            <x-table-card title="Pilih Produk">

                {{-- SEARCH --}}
                <div class="p-4 border-b" style="border-color:var(--border);">
                    <x-input-search 
                        id="searchProduk"
                        placeholder="Cari produk..."
                    />
                </div>

                <!-- LIST PRODUK -->
                <div id="produkList" class="overflow-y-auto max-h-[400px] divide-y">
                    @foreach($produks as $p)
                    <div class="flex items-center justify-between px-4 py-3"
                        data-nama="{{ strtolower($p->nama_produk) }}"
                        >

                        <div>
                            <div class="font-semibold text-sm">{{ $p->nama_produk }}</div>
                            <div class="text-xs text-gray-500">
                                Rp {{ number_format($p->harga_jual) }}
                            </div>
                        </div>

                        <x-button 
                            type="button"
                            onclick="addItem({{ $p->id }}, '{{ addslashes($p->nama_produk) }}', {{ $p->harga_jual }}, {{ $p->stok }})"
                            class="w-8 h-8 p-3! text-lg"
                            >
                            +
                        </x-button>

                    </div>
                    @endforeach
                </div>

            </x-table-card>

            {{-- ── KOLOM 2: Keranjang ── --}}
            <x-table-card title="Keranjang" fullHeight>

                <div id="cartItems" class="p-4 flex-1 overflow-y-auto"></div>

                <div class="px-4 py-3 border-t flex justify-between font-semibold mt-auto">
                    <span>Total</span>
                    <span id="dispTotal">Rp 0</span>
                </div>

            </x-table-card>

            {{-- ── KOLOM 3: Pembayaran ── --}}
            <x-table-card title="Pembayaran" fullHeight>

                <div class="p-4 flex flex-col flex-1 space-y-3">

                    <x-input 
                        type="number"
                        id="inputBayar"
                        name="bayar"
                        placeholder="0"
                        oninput="hitungKembalian()"
                    />

                    <div class="grid grid-cols-2 gap-2">
                        @foreach([50000,100000,150000,200000] as $n)
                        <x-button 
                            type="button"
                            variant="outline"
                            onclick="setBayar({{ $n }})">
                            Rp {{ number_format($n,0,',','.') }}
                        </x-button>
                        @endforeach
                    </div>

                    <div class="text-center py-4">
                        <div class="text-sm">Kembalian</div>
                        <div id="dispKembalian" class="text-2xl font-bold">Rp 0</div>
                    </div>

                    <div class="mt-auto">
                        <x-button 
                            type="submit"
                            id="btnSimpan"
                            disabled
                            class="w-full">
                            Simpan Transaksi
                        </x-button>
                    </div>

                </div>

            </x-table-card>

        </div>
    </form>

    <script>
    // ─── STATE ───────────────────────────────────────────────────────────────────
    let cart = {};

    // ─── HELPERS ─────────────────────────────────────────────────────────────────
    function fmt(n) {
        return 'Rp ' + Number(n).toLocaleString('id-ID');
    }
    function getTotal() {
        return Object.values(cart).reduce((s, i) => s + i.harga * i.qty, 0);
    }
    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    // ─── TAMBAH PRODUK ───────────────────────────────────────────────────────────
    function addItem(id, nama, harga, maxStok) {
        // 🔥 RESET SEARCH
    const input = document.getElementById('searchProduk');
    input.value = '';

    // tampilkan semua produk lagi
    const items = document.querySelectorAll('#produkList > div');
    items.forEach(item => item.style.display = '');

    // optional biar fokus balik
    input.focus();

        id = String(id);
        if (maxStok <= 0) { alert('Stok habis!'); return; }
        if (cart[id]) {
            if (cart[id].qty >= cart[id].maxStok) { alert('Stok tidak mencukupi!'); return; }
            cart[id].qty++;
        } else {
            cart[id] = { nama, harga, qty: 1, maxStok };
        }
        renderCart();
        hitungKembalian();
    }

    // ─── UBAH QTY ────────────────────────────────────────────────────────────────
    function changeQty(id, delta) {
        id = String(id);
        if (!cart[id]) return;
        const newQty = cart[id].qty + delta;
        if (newQty <= 0) {
            delete cart[id];
        } else if (newQty > cart[id].maxStok) {
            alert('Stok tidak mencukupi!'); return;
        } else {
            cart[id].qty = newQty;
        }
        renderCart();
        hitungKembalian();
    }

    // ─── RENDER KERANJANG ────────────────────────────────────────────────────────
    // Bangun seluruh HTML sekaligus (bukan innerHTML +=) lalu set sekali.
    // Ini mencegah glitch re-render dan DOM corruption.
    function renderCart() {
        const container = document.getElementById('cartItems');
        const hidden    = document.getElementById('hiddenInputs');
        const entries   = Object.entries(cart);

        if (entries.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center h-full py-10 text-sm"
                    style="color:var(--slate);">
                    <div style="font-size:2rem;margin-bottom:.5rem;">🛒</div>
                    Keranjang kosong
                </div>`;
            hidden.innerHTML = '';
        } else {
            let cartHtml   = '';
            let hiddenHtml = '';

            entries.forEach(([id, item], idx) => {
                const sub = item.harga * item.qty;
                cartHtml += `
                <div class="py-3 flex items-center gap-3">
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-semibold truncate">${escHtml(item.nama)}</div>
                        <div class="text-xs mt-0.5" style="color:var(--slate);">${fmt(item.harga)} / item</div>
                    </div>
                    <div class="flex items-center gap-1.5 shrink-0">
                        <button type="button" onclick="changeQty('${id}', -1)"
                                class="w-6 h-6 rounded-lg border text-sm font-bold flex items-center justify-center hover:bg-gray-50"
                                style="border-color:var(--border);">−</button>
                        <span class="text-sm font-bold w-6 text-center">${item.qty}</span>
                        <button type="button" onclick="changeQty('${id}', 1)"
                                class="w-6 h-6 rounded-lg border text-sm font-bold flex items-center justify-center hover:bg-gray-50"
                                style="border-color:var(--border);">+</button>
                    </div>
                    <div class="text-sm font-semibold shrink-0 text-right" style="min-width:80px;">${fmt(sub)}</div>
                </div>`;

                // Input hidden WAJIB ada untuk dikirim ke controller
                hiddenHtml += `
                <input type="hidden" name="items[${idx}][id]" value="${id}">
                <input type="hidden" name="items[${idx}][jumlah]" value="${item.qty}">
                <input type="hidden" name="items[${idx}][harga_satuan]" value="${item.harga}">`;
            });

            container.innerHTML = cartHtml;
            hidden.innerHTML    = hiddenHtml;   // hidden ada di dalam <form>
        }

        document.getElementById('dispTotal').textContent = fmt(getTotal());
        updateSimpanBtn();
    }

    // ─── HITUNG KEMBALIAN ────────────────────────────────────────────────────────
    function hitungKembalian() {
        const total = getTotal();
        const input = document.getElementById('inputBayar');
        const elK   = document.getElementById('dispKembalian');

        // 🔥 kalau kosong → jangan hitung
        if (input.value === '') {
            elK.textContent = '-';
            elK.style.color = 'var(--slate)';
            updateSimpanBtn();
            return;
        }

        const bayar   = parseInt(input.value) || 0;
        const kembali = bayar - total;

        if (kembali < 0) {
            elK.textContent = '- ' + fmt(Math.abs(kembali));
            elK.style.color = '#DC2626';
        } else {
            elK.textContent = fmt(kembali);
            elK.style.color = 'var(--pine)';
        }

        updateSimpanBtn();
    }

    // ─── TOMBOL SIMPAN ───────────────────────────────────────────────────────────
    function updateSimpanBtn() {
        const total = getTotal();
        const input = document.getElementById('inputBayar');
        const hasItems = Object.keys(cart).length > 0;

        // 🔥 kalau belum isi bayar → disable
        if (input.value === '') {
            document.getElementById('btnSimpan').disabled = true;
            return;
        }

        const bayar = parseInt(input.value) || 0;
        const cukup = total > 0 && bayar >= total;

        document.getElementById('btnSimpan').disabled = !(hasItems && cukup);

        document.addEventListener('DOMContentLoaded', () => {
            updateSimpanBtn();
        });
    }

    // ─── SHORTCUT NOMINAL ────────────────────────────────────────────────────────
    function setBayar(nominal) {
        document.getElementById('inputBayar').value = nominal;
        hitungKembalian();
    }

    // ─── VALIDASI FINAL SEBELUM SUBMIT ───────────────────────────────────────────
    // Ini guard terakhir — memastikan data valid sebelum form dikirim.

    function validateForm() {
        const entries = Object.entries(cart);

        if (entries.length === 0) {
            alert('Keranjang masih kosong!');
            return false;
        }

        const total = getTotal();
        const bayar = parseInt(document.getElementById('inputBayar').value) || 0;

        if (bayar < total) {
            alert('Jumlah bayar kurang dari total!');
            return false;
        }

        // ✅ FIX DI SINI (produk_id → id)
        const hidden = document.getElementById('hiddenInputs');
        let hiddenHtml = '';

        entries.forEach(([id, item], idx) => {
            hiddenHtml += `
            <input type="hidden" name="items[${idx}][id]" value="${id}">
            <input type="hidden" name="items[${idx}][jumlah]" value="${item.qty}">
            <input type="hidden" name="items[${idx}][harga_satuan]" value="${item.harga}">`;
        });

        hidden.innerHTML = hiddenHtml;

        return true;
    }

    // ─── PENCARIAN PRODUK ───────────────────────────────────────────────────────
    document.getElementById('searchProduk').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const items = document.querySelectorAll('#produkList > div');

        items.forEach(item => {
            const nama = item.getAttribute('data-nama');

            if (nama.includes(keyword)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    </script>

@endsection