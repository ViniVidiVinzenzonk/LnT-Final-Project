
<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>
<h2>Login</h2>
<form action="/login" method="POST" style='max-width:400px;'>
    <?php echo csrf_field(); ?>
    <div class='mb-3'>
        <label class='form-label'>Email</label>
        <input type="email" name="email" class='form-control' value='<?php echo e(old("email")); ?>'>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Password</label>
        <input type="password" name="password" class='form-control'>
    </div>
    <button class='btn btn-primary'>Masuk</button>
</form>
<p class='mt-3'>Belum punya akun? <a href="/register">Register di sini</a></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MIDPROJECT\resources\views/auth/login.blade.php ENDPATH**/ ?>