@extends('layout.master')
@section('title', 'Tambah Barang')
@section('content')
<h2>Tambah Barang Baru</h2>
<form action="/admin/barang" method="POST" enctype="multipart/form-data">
    @csrf
    <div class='mb-3'>
        <label class='form-label'>Kategori</label>
        <select name="kategori_id" class='form-control'>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
        @if($kategoris->isEmpty())
            <small style='color:red;'>Belum ada kategori! <a href="/admin/kategori">Tambah dulu</a></small>
        @endif
    </div>
    <div class='mb-3'>
        <label class='form-label'>Nama Barang</label>
        <input type="text" name="nama_barang" class='form-control' value='{{ old("nama_barang") }}'>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Harga Barang</label>
        <div class='input-group'>
            <span class='input-group-text'>Rp.</span>
            <input type="number" name="harga_barang" class='form-control' value='{{ old("harga_barang") }}' min="0">
        </div>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Jumlah Barang</label>
        <input type="number" name="jumlah_barang" class='form-control' value='{{ old("jumlah_barang") }}' min="0">
    </div>
    <div class='mb-3'>
        <label class='form-label'>Foto Barang</label>
        <input type="file" name="foto_barang" class='form-control' accept="image/*">
    </div>
    <button class='btn btn-primary'>Simpan</button>
    <a href="/admin/barang" class='btn btn-secondary'>Batal</a>
</form>
@endsection