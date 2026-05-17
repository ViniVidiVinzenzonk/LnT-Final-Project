<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'   => 'required',
            'nama_barang'   => 'required|string|min:5|max:80',
            'harga_barang'  => 'required|integer|min:0',
            'jumlah_barang' => 'required|integer|min:0',
            'foto_barang'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->except('foto_barang');

        // handle upload foto kalo ada
        if ($request->hasFile('foto_barang')) {
            $foto = $request->file('foto_barang');
            $namaFile = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/fotos', $namaFile);
            $data['foto_barang'] = $namaFile;
        }

        Barang::create($data);
        return redirect('/admin/barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang    = Barang::find($id);
        $kategoris = Kategori::all();
        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id'   => 'required',
            'nama_barang'   => 'required|string|min:5|max:80',
            'harga_barang'  => 'required|integer|min:0',
            'jumlah_barang' => 'required|integer|min:0',
            'foto_barang'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $barang = Barang::find($id);
        $data   = $request->except('foto_barang');

        if ($request->hasFile('foto_barang')) {
            $foto = $request->file('foto_barang');
            $namaFile = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/fotos', $namaFile);
            $data['foto_barang'] = $namaFile;
        }

        $barang->update($data);
        return redirect('/admin/barang')->with('success', 'Data barang berhasil diupdate!');
    }

    public function destroy($id)
    {
        Barang::find($id)->delete();
        return redirect('/admin/barang')->with('success', 'Barang berhasil dihapus.');
    }

    // halaman khusus buat ngelola kategori 
    public function kategoriIndex()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function kategoriStore(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|min:3',
        ]);
        Kategori::create($request->all());
        return redirect('/admin/kategori')->with('success', 'Kategori ditambahkan!');
    }

    public function kategoriDestroy($id)
    {
        Kategori::find($id)->delete();
        return redirect('/admin/kategori')->with('success', 'Kategori dihapus.');
    }
}