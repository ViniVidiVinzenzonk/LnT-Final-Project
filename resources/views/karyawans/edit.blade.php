@extends('layout.master')
@section('title', 'Edit Data Karyawan')
@section('content')
<h2>Edit Data Karyawan</h2>
<form action="/karyawans/{{ $karyawan->id }}/edit" method='POST'>
    @csrf
    @method('PUT')
    <div class = 'mb-3'>
        <label for="" class='form-label'>Nama</label>
        <input type="text" name = 'nama' class='form-control' value='{{ $karyawan->nama }}'>
    </div>

    <div class = 'mb-3'>
        <label for="" class='form-label'>Umur</label>
        <input type="number" name = 'umur' class='form-control' value='{{ $karyawan->umur }}'>
    </div>

    <div class = 'mb-3'>
        <label for="" class='form-label'>Alamat</label>
        <input type="text" name = 'alamat' class='form-control' value='{{ $karyawan->alamat }}'>
    </div>

    <div class = 'mb-3'>
        <label for="" class='form-label'>Nomor Telepon</label>
        <input type="text" name = 'no_telp' class='form-control' value='{{ $karyawan->no_telp }}'>
    </div>

    <button class='btn btn-primary'>Update Data</button>
</form>
@endsection