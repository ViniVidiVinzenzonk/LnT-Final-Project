<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Faktur;
use App\Models\FakturItem;
use Illuminate\Support\Facades\Auth;

class UserBarangController extends Controller
{
    // tampil semua barang (katalog)
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('user.index', compact('barangs'));
    }

    // tambah barang ke keranjang (session)
    public function tambahKeranjang(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return back()->with('error', 'Barang tidak ditemukan!');
        }

        if ($barang->jumlah_barang <= 0) {
            return back()->with('error', 'Barang sudah habis, silakan tunggu hingga barang di-restock ulang.');
        }

        $keranjang = session()->get('keranjang', []);

        // kalau barang udah ada di keranjang, tambah kuantitasnya
        if (isset($keranjang[$id])) {
            $keranjang[$id]['kuantitas'] += 1;
        } else {
            $keranjang[$id] = [
                'barang_id'      => $barang->id,
                'nama_barang'    => $barang->nama_barang,
                'harga_satuan'   => $barang->harga_barang,
                'kategori'       => $barang->kategori->nama_kategori,
                'kuantitas'      => 1,
                'stok'           => $barang->jumlah_barang,
            ];
        }

        session()->put('keranjang', $keranjang);
        return back()->with('success', $barang->nama_barang . ' berhasil ditambahkan ke faktur!');
    }

    // hapus item dari keranjang
    public function hapusKeranjang($id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
        }
        session()->put('keranjang', $keranjang);
        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    // update kuantitas di keranjang
    public function updateKeranjang(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            $kuantitas = (int) $request->kuantitas;
            if ($kuantitas <= 0) {
                unset($keranjang[$id]);
            } else {
                $keranjang[$id]['kuantitas'] = $kuantitas;
            }
        }
        session()->put('keranjang', $keranjang);
        return back();
    }

    // halaman buat faktur
    public function createFaktur()
    {
        $keranjang = session()->get('keranjang', []);
        if (empty($keranjang)) {
            return redirect('/barang')->with('error', 'Keranjang kamu masih kosong!');
        }
        return view('user.faktur.create', compact('keranjang'));
    }

    // simpen faktur ke database
    public function storeFaktur(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string|min:10|max:100',
            'kode_pos'          => 'required|string|digits:5',
        ]);

        $keranjang = session()->get('keranjang', []);
        if (empty($keranjang)) {
            return redirect('/barang')->with('error', 'Keranjang kosong, tidak bisa buat faktur.');
        }

        // generate nomor invoice otomatis, contoh: INV-20260215-0001
        $tanggal       = date('Ymd');
        $countFaktur   = Faktur::whereDate('created_at', today())->count();
        $nomorInvoice  = 'INV-' . $tanggal . '-' . str_pad($countFaktur + 1, 4, '0', STR_PAD_LEFT);

        // itung total
        $total = 0;
        foreach ($keranjang as $item) {
            $total += $item['harga_satuan'] * $item['kuantitas'];
        }

        $faktur = Faktur::create([
            'user_id'           => Auth::id(),
            'nomor_invoice'     => $nomorInvoice,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'kode_pos'          => $request->kode_pos,
            'total_harga'       => $total,
        ]);

        // simpen tiap item faktur + kurangi stok barang
        foreach ($keranjang as $barangId => $item) {
            FakturItem::create([
                'faktur_id'   => $faktur->id,
                'barang_id'   => $item['barang_id'],
                'nama_barang' => $item['nama_barang'],
                'harga_satuan' => $item['harga_satuan'],
                'kuantitas'   => $item['kuantitas'],
                'subtotal'    => $item['harga_satuan'] * $item['kuantitas'],
            ]);

            // ngurangin stok
            $barang = \App\Models\Barang::find($barangId);
            if ($barang) {
                $barang->jumlah_barang -= $item['kuantitas'];
                if ($barang->jumlah_barang < 0) $barang->jumlah_barang = 0; // biar angga mines
                $barang->save();
            }
        }

        // kosongkan keranjang setelah checkout
        session()->forget('keranjang');

        return redirect('/faktur/' . $faktur->id)->with('success', 'Faktur berhasil disimpan!');
    }

    // kasi liat faktur (halaman cetak)
    public function showFaktur($id)
    {
        $faktur = Faktur::with(['items', 'user'])->find($id);

        // pastiin yang lihat faktur ini == pemiliknya
        if ($faktur->user_id !== Auth::id()) {
            return redirect('/barang')->with('error', 'Ini bukan faktur kamu!');
        }

        return view('user.faktur.show', compact('faktur'));
    }
}