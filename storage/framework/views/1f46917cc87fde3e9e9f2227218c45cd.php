
<?php $__env->startSection('title', 'Register'); ?>
<?php $__env->startSection('content'); ?>
<h2>Daftar Akun Baru</h2>
<form action="/register" method="POST" style='max-width:500px;'>
    <?php echo csrf_field(); ?>
    <div class='mb-3'>
        <label class='form-label'>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class='form-control' value='<?php echo e(old("nama_lengkap")); ?>'>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Email</label>
        <input type="email" name="email" class='form-control' value='<?php echo e(old("email")); ?>'>
        <small class='text-muted'>harus @gmail.com ya</small>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Password</label>
        <input type="password" name="password" class='form-control'>
        <small class='text-muted'>6-12 karakter</small>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class='form-control'>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Nomor HP</label>
        <input type="text" name="no_hp" class='form-control' value='<?php echo e(old("no_hp")); ?>'>
        <small class='text-muted'>harus diawali 08</small>
    </div>
    <button class='btn btn-primary'>Daftar</button>
</form>
<p class='mt-3'>Sudah punya akun? <a href="/login">Login di sini</a></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MIDPROJECT\resources\views/auth/register.blade.php ENDPATH**/ ?>