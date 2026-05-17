@extends('layout.master')
@section('title', 'Tambahkan Karyawan Baru')
@section('content')
<h2>Tambahkan Karyawan Baru</h2>
<form action="/karyawans" method='POST'>
    @csrf
    <div class = 'mb-3'>
        <label for="" class='form-label'>Nama</label>
        <input type="text" name = 'nama' class='form-control'>
    </div>

    <div class = 'mb-3'>
        <label for="" class='form-label'>Umur</label>
        <input type="number" name = 'umur' class='form-control'>
    </div>

    <div class = 'mb-3'>
        <label for="" class='form-label'>Alamat</label>
        <input type="text" name = 'alamat' class='form-control'>
    </div>

    <div class = 'mb-3'>
        <label for="" class='form-label'>Nomor Telepon</label>
        <input type="text" name = 'no_telp' class='form-control'>
    </div>

    <button class='btn btn-primary'>Simpan Data</button>
</form>
@endsection