@extends('layout.master')
@section('title', 'Buat Faktur')
@section('content')
<h2>Keranjang</h2>
<div class='row'>
    <div class='col-md-7'>
        <table class='table table-bordered'>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Kuantitas</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
            @php $total = 0; @endphp
            @foreach($keranjang as $id => $item)
            @php $subtotal = $item['harga_satuan'] * $item['kuantitas']; $total += $subtotal; @endphp
            <tr>
                <td>{{ $item['nama_barang'] }}</td>
                <td>{{ $item['kategori'] }}</td>
                <td>Rp. {{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                <td>
                    <form action="/keranjang/{{ $id }}/update" method="POST" style="display:flex; gap:5px;">
                        @csrf
                        <input type="number" name="kuantitas" value="{{ $item['kuantitas'] }}"
                               min="1" class='form-control form-control-sm' style='width:65px;'>
                        <button class='btn btn-sm btn-primary'>ok</button>
                    </form>
                </td>
                <td>Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                <td>
                    <form action="/keranjang/{{ $id }}/hapus" method="POST">
                        @csrf
                        <button class='btn btn-danger btn-sm'>x</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class='text-end'><strong>Total</strong></td>
                <td colspan="2"><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
        <a href="/barang" class='btn btn-secondary btn-sm'>Lanjut Belanja</a>
    </div>

    <div class='col-md-5'>
        <h5>Data Pengiriman</h5>
        <form action="/faktur/simpan" method="POST">
            @csrf
            <div class='mb-3'>
                <label class='form-label'>Alamat Pengiriman</label>
                <textarea name="alamat_pengiriman" class='form-control' rows="3">{{ old('alamat_pengiriman') }}</textarea>
                <small class='text-muted'>min 10, max 100 huruf</small>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Kode Pos</label>
                <input type="text" name="kode_pos" class='form-control' value='{{ old("kode_pos") }}' maxlength="5">
                <small class='text-muted'>5 digit angka</small>
            </div>
            <button class='btn btn-primary'>Buat Faktur</button>
        </form>
    </div>
</div>
@endsection