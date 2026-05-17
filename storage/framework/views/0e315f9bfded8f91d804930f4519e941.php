
<?php $__env->startSection('title', 'Tambah Barang'); ?>
<?php $__env->startSection('content'); ?>
<h2>Tambah Barang Baru</h2>
<form action="/admin/barang" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class='mb-3'>
        <label class='form-label'>Kategori</label>
        <select name="kategori_id" class='form-select'>
            <option value="">-- Pilih Kategori --</option>
            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($kategori->id); ?>"><?php echo e($kategori->nama_kategori); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        
        <?php if($kategoris->isEmpty()): ?>
            <small style='color:#ff7ab0;'>Belum ada kategori! <a href="/admin/kategori">Tambah kategori dulu di sini</a></small>
        <?php endif; ?>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Nama Barang</label>
        <input type="text" name="nama_barang" class='form-control' value='<?php echo e(old("nama_barang")); ?>' placeholder="minimal 5, maksimal 80 huruf">
    </div>
    <div class='mb-3'>
        <label class='form-label'>Harga Barang</label>
        <div class='input-group'>
            <span class='input-group-text' style='background-color:#ffe4e9; border-color:#ffccd5; color:#8b4357;'>Rp.</span>
            <input type="number" name="harga_barang" class='form-control' value='<?php echo e(old("harga_barang")); ?>' min="0">
        </div>
    </div>
    <div class='mb-3'>
        <label class='form-label'>Jumlah Barang</label>
        <input type="number" name="jumlah_barang" class='form-control' value='<?php echo e(old("jumlah_barang")); ?>' min="0">
    </div>
    <div class='mb-3'>
        <label class='form-label'>Foto Barang</label>
        <input type="file" name="foto_barang" class='form-control' accept="image/*">
        <small style='color:#aaa;'>Format: jpg, jpeg, png, gif. Maksimal 2MB.</small>
    </div>
    <button class='btn btn-primary'>Simpan Barang</button>
    <a href="/admin/barang" class='btn btn-secondary ms-2'>Batal</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MIDPROJECT\resources\views/admin/barang/create.blade.php ENDPATH**/ ?>