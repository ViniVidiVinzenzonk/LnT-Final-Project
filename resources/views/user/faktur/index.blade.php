@extends('layout.master')
@section('title', 'Buat Faktur')
@section('content')
<h2>🧾 Keranjang & Faktur 💵💶💷</h2>

<div class='row'>
    {{-- tabel keranjang --}}
    <div class='col-md-7'>
        <h5 style='color:#8b4357;'>Barang di Keranjang</h5>
        <table class='table table-bordered'>
            <thead>
                <tr><th>Nama Barang</th><th>Kategori</th><th>Harga Satuan</th><th>Kuantitas</th><th>Subtotal</th><th></th></tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($keranjang as $id => $item)
                @php $subtotal = $item['harga_satuan'] * $item['kuantitas']; $total += $subtotal; @endphp
                <tr>
                    <td>{{ $item['nama_barang'] }}</td>
                    <td>{{ $item['kategori'] }}</td>
                    <td>Rp. {{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                    <td>
                        {{-- form apdate kuantitas --}}
                        <form action="/keranjang/{{ $id }}/update" method="POST" style="display:flex; gap:5px; align-items:center;">
                            @csrf
                            <input type="number" name="kuantitas" value="{{ $item['kuantitas'] }}" min="1"
                                   max="{{ $item['stok'] }}" class='form-control form-control-sm' style='width:70px;'>
                            <button class='btn btn-sm btn-primary'>✓</button>
                        </form>
                    </td>
                    <td>Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                    <td>
                        <form action="/keranjang/{{ $id }}/hapus" method="POST">
                            @csrf
                            <button class='btn btn-danger btn-sm'>✕</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class='text-end fw-bold' style='color:#8b4357;'>Total:</td>
                    <td colspan="2" class='fw-bold' style='color:#8b4357;'>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <a href="/barang" class='btn btn-secondary btn-sm'>← Lanjut Belanja</a>
    </div>

    {{-- form alamat --}}
    <div class='col-md-5'>
        <div class='card' style='border-color:#ffccd5;'>
            <div class='card-body'>
                <h5 style='color:#8b4357;'>Data Pengiriman</h5>
                <form action="/faktur/simpan" method="POST">
                    @csrf
                    <div class='mb-3'>
                        <label class='form-label'>Alamat Pengiriman</label>
                        <textarea name="alamat_pengiriman" class='form-control' rows="3"
                            placeholder="Minimal 10, maksimal 100 huruf">{{ old('alamat_pengiriman') }}</textarea>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label'>Kode Pos</label>
                        <input type="text" name="kode_pos" class='form-control' value='{{ old("kode_pos") }}'
                               placeholder="5 digit angka, contoh: 40211" maxlength="5">
                    </div>
                    <button class='btn btn-success w-100'>🧾 Buat & Simpan Faktur</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection