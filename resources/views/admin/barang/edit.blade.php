@extends('layout.master')
@section('title', 'Edit Barang')
@section('content')
<h2>Edit Data Barang</h2>
<form action="/admin/barang/{{ $barang->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class='mb-3'>
        <label class='form-label'>Kategori</label>
        <select name="kategori_id" class='form-control'>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Nama Barang</label>
        <input type="text" name="nama_barang" class='form-control' value='{{ $barang->nama_barang }}'>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Harga Barang</label>
        <div class='input-group'>
            <span class='input-group-text'>Rp.</span>
            <input type="number" name="harga_barang" class='form-control' value='{{ $barang->harga_barang }}'>
        </div>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Jumlah Barang</label>
        <input type="number" name="jumlah_barang" class='form-control' value='{{ $barang->jumlah_barang }}'>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Foto Barang</label>
        @if($barang->foto_barang)
            <div class='mb-2'>
                <img src="{{ asset('storage/fotos/' . $barang->foto_barang) }}" width="80">
                <small class='text-muted d-block'>foto sekarang, upload baru kalau mau ganti</small>
            </div>
        @endif
        <input type="file" name="foto_barang" class='form-control' accept="image/*">
    </div>
    <button class='btn btn-primary'>Update</button>
    <a href="/admin/barang" class='btn btn-secondary'>Batal</a>
</form>
@endsection