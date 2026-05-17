@extends('layout.master')
@section('title', 'Login')
@section('content')
<h2>Login</h2>
<form action="/login" method="POST" style='max-width:400px;'>
    @csrf
    <div class='mb-3'>
        <label class='form-label'>Email</label>
        <input type="email" name="email" class='form-control' value='{{ old("email") }}'>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Password</label>
        <input type="password" name="password" class='form-control'>
    </div>
    <button class='btn btn-primary'>Masuk</button>
</form>
<p class='mt-3'>Belum punya akun? <a href="/register">Register di sini</a></p>
@endsection