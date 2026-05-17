@extends('layout.master')
@section('title', 'Kelola Barang')
@section('content')
<h2>Daftar Barang</h2>
<a href="/admin/barang/create" class='btn btn-primary mb-3'>Tambah Barang</a>

<table class='table table-bordered'>
    <tr>
        <th>Foto</th>
        <th>Kategori</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    @foreach($barangs as $barang)
    <tr>
        <td>
            @if($barang->foto_barang)
                <img src="{{ asset('storage/fotos/' . $barang->foto_barang) }}" width="60">
            @else
                -
            @endif
        </td>
        <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
        <td>{{ $barang->nama_barang }}</td>
        <td>Rp. {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
        <td>
            @if($barang->jumlah_barang <= 0)
                <span class='badge bg-danger'>Habis</span>
            @else
                {{ $barang->jumlah_barang }}
            @endif
        </td>
        <td>
            <a href="/admin/barang/{{ $barang->id }}/edit" class='btn btn-warning btn-sm'>Edit</a>
            <form action="/admin/barang/{{ $barang->id }}/delete" method="POST" style="display:inline"
                onsubmit="return confirm('Yakin mau hapus?');">
                @csrf
                <button class='btn btn-danger btn-sm'>Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection