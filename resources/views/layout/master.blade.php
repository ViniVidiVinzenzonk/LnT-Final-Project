<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PT ECOAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    {{-- aku bikin pink pastel yaa biar lucuuk hehe --}}
    <style>
        body{
            background-color: #fff5f7;
            font-family: 'Times New Roman';
        }
        
        .navbar {
            background-color: #ffb3c6 !important;
            padding: 15px;
            margin-bottom: 30px;
        }
        
        .navbar-brand {
            color: #8b4357 !important;
            font-weight: bold;
            font-size: 1.3rem;
        }
        
        .navbar-brand:hover {
            color: #5d3a4a !important;
        }
        
        .container {
            max-width: 1000px;
            margin-top: 20px;
        }

        h2 {
            color: #8b4357;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        .form-label {
            color: #8b4357;
            font-weight: bold;
        }
        
        .form-control {
            border-color: #ffccd5;
        }
        
        .btn-primary {
            background-color: #ffb3d9;
            border-color: #ffb3d9;
            color: #5d3a4a;
        }
        
        .btn-primary:hover {
            background-color: #ff99c8;
            border-color: #ff99c8;
            color: #5d3a4a;
        }
        
        .btn-warning {
            background-color: #ffd4e5;
            border-color: #ffd4e5;
            color: #8b4357;
        }
        
        .btn-danger {
            background-color: #ff99c8;
            border-color: #ff99c8;
            color: white;
        }
        
        .table {
            background-color: white;
        }
        
        .table thead {
            background-color: #ffe4e9;
            color: #8b4357;
        }

        .table td, .table th {
            border-color: #ffccd5;
        }
    </style>
</head>
<body>
    <nav class='navbar navbar-dark bg-dark mb-4'>
        <div class='container'>
            <a href="/" class='navbar-brand'>PT ECOAS Shop</a>

            {{-- navbar buat yang udah login --}}
            <div style='display:flex; gap:15px; align-items:center;'>
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="/admin/barang" class='btn btn-sm btn-light'>Kelola Barang</a>
                    <a href="/admin/kategori" class='btn btn-sm btn-light'>Kategori</a>
                @else
                    <a href="/barang" class='btn btn-sm btn-light'>Katalog</a>
                    <a href="/faktur/buat" class='btn btn-sm btn-light'>
                        Keranjang
                        @if(session('keranjang') && count(session('keranjang')) > 0)
                            ({{ count(session('keranjang')) }})
                        @endif
                    </a>
                @endif
                <span class='text-white'>Hi, {{ Auth::user()->nama_lengkap }}!</span>
                <form action="/logout" method="POST" style="display:inline">
                    @csrf
                    <button class='btn btn-sm btn-danger'>Logout</button>
                </form>
            @else
                <a href="/login" class='btn btn-sm btn-light'>Login</a>
                <a href="/register" class='btn btn-sm btn-light'>Register</a>
            @endauth
            </div>
        </div>
    </nav>

    <div class='container'>
        @if(session('success'))
            <div class='alert alert-success'>{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class='alert alert-danger'>{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class='alert alert-danger'>
                <ul class='mb-0'>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>