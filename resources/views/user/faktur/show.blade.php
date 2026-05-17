@extends('layout.master')
@section('title', 'Faktur')
@section('content')
<div style='max-width:650px;'>
    <div class='d-flex justify-content-between align-items-center mb-3'>
        <h2>Faktur Pembelian</h2>
        <button onclick="window.print()" class='btn btn-primary'>Cetak</button>
    </div>

    <table class='table table-bordered'>
        <tr><td><strong>Nomor Invoice</strong></td><td>{{ $faktur->nomor_invoice }}</td></tr>
        <tr><td><strong>Tanggal</strong></td><td>{{ $faktur->created_at->format('d M Y, H:i') }} WIB</td></tr>
        <tr><td><strong>Nama Pembeli</strong></td><td>{{ $faktur->user->nama_lengkap }}</td></tr>
        <tr><td><strong>Alamat Pengiriman</strong></td><td>{{ $faktur->alamat_pengiriman }}</td></tr>
        <tr><td><strong>Kode Pos</strong></td><td>{{ $faktur->kode_pos }}</td></tr>
    </table>

    <h5 class='mt-4'>Detail Barang</h5>
    <table class='table table-bordered'>
        <tr>
            <th>Nama Barang</th>
            <th>Harga Satuan</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        @foreach($faktur->items as $item)
        <tr>
            <td>{{ $item->nama_barang }}</td>
            <td>Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
            <td>x{{ $item->kuantitas }}</td>
            <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3" class='text-end'><strong>Total</strong></td>
            <td><strong>Rp. {{ number_format($faktur->total_harga, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    <p class='text-muted'>Terima kasih sudah berbelanja!</p>
</div>

<style>
    @media print {
        nav, button { display:none !important; }
    }
</style>
@endsection