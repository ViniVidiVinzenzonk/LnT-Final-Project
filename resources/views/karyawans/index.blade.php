@extends('layout.master')
@section('title', 'Daftar Karyawan')
@section('content')
    <a href="/karyawans/create" class='btn btn-primary mb-3'>Tambah Karyawan</a>
    <table class = 'table table-bordered'>
        <tr>
            <th>Nama</th>
            <th>Umur</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
        </tr>

            @foreach($karyawans as $karyawan)
            <tr>
                <td>{{ $karyawan->nama }}</td>
                <td>{{ $karyawan->umur }}</td>
                <td>{{ $karyawan->alamat }}</td>
                <td>{{ $karyawan->no_telp }}</td>
                <td>
                    <a href="/karyawans/{{$karyawan->id}}/edit" class='btn btn-warning btn-sm'>Edit</a>
                    <form action="/karyawans/{{$karyawan->id}}/delete"
                    method='POST'
                    style='display:inline'
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data karyawan ini?');">
                    @csrf
                    <button class='btn btn-danger btn-sm'> Hapus</button>
                </form>
                </td>
            </tr>
            @endforeach
    </table>
    @endsection