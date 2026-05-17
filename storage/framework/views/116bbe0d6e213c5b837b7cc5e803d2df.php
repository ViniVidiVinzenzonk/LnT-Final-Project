
<?php $__env->startSection('title', 'Kelola Barang'); ?>
<?php $__env->startSection('content'); ?>
<h2>Daftar Barang</h2>
<a href="/admin/barang/create" class='btn btn-primary mb-3'>Tambah Barang</a>

<table class='table table-bordered'>
    <tr>
        <th>Foto</th>
        <th>Kategori</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td>
            <?php if($barang->foto_barang): ?>
                <img src="<?php echo e(asset('storage/fotos/' . $barang->foto_barang)); ?>" width="60">
            <?php else: ?>
                -
            <?php endif; ?>
        </td>
        <td><?php echo e($barang->kategori->nama_kategori ?? '-'); ?></td>
        <td><?php echo e($barang->nama_barang); ?></td>
        <td>Rp. <?php echo e(number_format($barang->harga_barang, 0, ',', '.')); ?></td>
        <td>
            <?php if($barang->jumlah_barang <= 0): ?>
                <span class='badge bg-danger'>Habis</span>
            <?php else: ?>
                <?php echo e($barang->jumlah_barang); ?>

            <?php endif; ?>
        </td>
        <td>
            <a href="/admin/barang/<?php echo e($barang->id); ?>/edit" class='btn btn-warning btn-sm'>Edit</a>
            <form action="/admin/barang/<?php echo e($barang->id); ?>/delete" method="POST" style="display:inline"
                onsubmit="return confirm('Yakin mau hapus?');">
                <?php echo csrf_field(); ?>
                <button class='btn btn-danger btn-sm'>Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MIDPROJECT\resources\views/admin/barang/index.blade.php ENDPATH**/ ?>