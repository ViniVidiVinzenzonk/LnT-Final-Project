@extends('layout.master')
@section('title', 'Katalog Barang')
@section('content')
<h2>Katalog Barang</h2>
<div class='row'>
    @foreach($barangs as $barang)
    <div class='col-md-4 mb-4'>
        <div class='card'>
            @if($barang->foto_barang)
                <img src="{{ asset('storage/fotos/' . $barang->foto_barang) }}"
                     class='card-img-top' style='height:180px; object-fit:cover;'>
            @else
                <div style='height:180px; background:#ffe4e9; display:flex; align-items:center; justify-content:center;'>
                    <span style='color:#ccc;'>Tidak ada foto</span>
                </div>
            @endif
            <div class='card-body'>
                <small class='text-muted'>{{ $barang->kategori->nama_kategori ?? '-' }}</small>
                <h6 class='card-title'>{{ $barang->nama_barang }}</h6>
                <p class='card-text'>Rp. {{ number_format($barang->harga_barang, 0, ',', '.') }}</p>
                <p class='card-text'>
                    @if($barang->jumlah_barang <= 0)
                        <small class='text-danger'>Barang sudah habis, silakan tunggu hingga barang di-restock ulang</small>
                    @else
                        <small class='text-muted'>Stok: {{ $barang->jumlah_barang }}</small>
                    @endif
                </p>
                @if($barang->jumlah_barang <= 0)
                    <button class='btn btn-secondary btn-sm' disabled>Stok Habis</button>
                @else
                    <form action="/barang/{{ $barang->id }}/keranjang" method="POST">
                        @csrf
                        <button class='btn btn-primary btn-sm'>Masukkan ke Faktur</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection