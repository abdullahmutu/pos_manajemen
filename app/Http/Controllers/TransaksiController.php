<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with('user')->orderByDesc('created_at');

        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $transaksis = $query->paginate(10)->withQueryString();
        $totalHari  = Transaksi::whereDate('created_at', today())->sum('total_harga');

        return view('transaksi.index', compact('transaksis', 'totalHari'));
    }

    public function create()
    {
        $produks = Produk::where('stok', '>', 0)->orderBy('nama_produk')->get();
        return view('transaksi.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items'         => 'required|array|min:1',
            'items.*.id'    => 'required|exists:produks,id',
            'items.*.jumlah'=> 'required|integer|min:1',
            'bayar'         => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $itemsData = [];

            foreach ($request->items as $item) {
                $produk = Produk::findOrFail($item['id']);
                if ($produk->stok < $item['jumlah']) {
                    return back()->with('error', "Stok {$produk->nama_produk} tidak mencukupi (stok: {$produk->stok}).");
                }
                $subtotal = $produk->harga_jual * $item['jumlah'];
                $total += $subtotal;
                $itemsData[] = [
                    'produk'    => $produk,
                    'jumlah'    => $item['jumlah'],
                    'subtotal'  => $subtotal,
                ];
            }

            if ($total <= 0) {
                return back()->with('error', 'Total transaksi tidak valid.');
            }

            if ($request->bayar < $total) {
                return back()->with('error', 'Jumlah bayar kurang dari total harga.');
            }

            $transaksi = Transaksi::create([
                'user_id' => auth()->id() ?? 1,
                'no_transaksi' => Transaksi::generateNoTransaksi(),
                'total_harga'  => $total,
                'bayar'        => $request->bayar,
                'kembalian'    => $request->bayar - $total,
                'catatan'      => $request->catatan,
            ]);

            foreach ($itemsData as $data) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id'    => $data['produk']->id,
                    'jumlah'       => $data['jumlah'],
                    'harga_satuan' => $data['produk']->harga_jual,
                    'subtotal'     => $data['subtotal'],
                ]);
                $data['produk']->decrement('stok', $data['jumlah']);
            }

            DB::commit();
            return redirect()->route('transaksi.show', $transaksi)->with('success', 'Transaksi berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('details.produk', 'user');
        return view('transaksi.show', compact('transaksi'));
    }

    public function destroy(Transaksi $transaksi)
    {
        // Kembalikan stok
        foreach ($transaksi->details as $detail) {
            $detail->produk->increment('stok', $detail->jumlah);
        }
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
