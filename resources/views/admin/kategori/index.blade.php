@extends('layout.master')
@section('title', 'Kelola Kategori')
@section('content')
<h2>🏷️ Kelola Kategori</h2>
<div class='row'>
    <div class='col-md-4'>
        <div class='card' style='border-color:#ffccd5;'>
            <div class='card-body'>
                <h5 style='color:#8b4357;'>Tambah Kategori Baru</h5>
                <form action="/admin/kategori" method="POST">
                    @csrf
                    <div class='mb-3'>
                        <label class='form-label'>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class='form-control' placeholder="contoh: Elektronik">
                    </div>
                    <button class='btn btn-primary'>Tambah</button>
                </form>
            </div>
        </div>
    </div>
    <div class='col-md-8'>
        <table class='table table-bordered'>
            <thead><tr><th>No</th><th>Nama Kategori</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($kategoris as $i => $kategori)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>
                        <form action="/admin/kategori/{{ $kategori->id }}/delete" method="POST" style="display:inline"
                            onsubmit="return confirm('Hapus kategori ini? Barang yang ada di kategori ini juga ikut terhapus!');">
                            @csrf
                            <button class='btn btn-danger btn-sm'>Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class='text-center' style='color:#aaa;'>Belum ada kategori</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection