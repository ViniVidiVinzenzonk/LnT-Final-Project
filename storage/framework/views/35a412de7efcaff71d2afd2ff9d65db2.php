
<?php $__env->startSection('title', 'Katalog Barang'); ?>
<?php $__env->startSection('content'); ?>
<h2>Katalog Barang</h2>
<div class='row'>
    <?php $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class='col-md-4 mb-4'>
        <div class='card'>
            <?php if($barang->foto_barang): ?>
                <img src="<?php echo e(asset('storage/fotos/' . $barang->foto_barang)); ?>"
                     class='card-img-top' style='height:180px; object-fit:cover;'>
            <?php else: ?>
                <div style='height:180px; background:#ffe4e9; display:flex; align-items:center; justify-content:center;'>
                    <span style='color:#ccc;'>Tidak ada foto</span>
                </div>
            <?php endif; ?>
            <div class='card-body'>
                <small class='text-muted'><?php echo e($barang->kategori->nama_kategori ?? '-'); ?></small>
                <h6 class='card-title'><?php echo e($barang->nama_barang); ?></h6>
                <p class='card-text'>Rp. <?php echo e(number_format($barang->harga_barang, 0, ',', '.')); ?></p>
                <p class='card-text'>
                    <?php if($barang->jumlah_barang <= 0): ?>
                        <small class='text-danger'>Barang sudah habis, silakan tunggu hingga barang di-restock ulang</small>
                    <?php else: ?>
                        <small class='text-muted'>Stok: <?php echo e($barang->jumlah_barang); ?></small>
                    <?php endif; ?>
                </p>
                <?php if($barang->jumlah_barang <= 0): ?>
                    <button class='btn btn-secondary btn-sm' disabled>Stok Habis</button>
                <?php else: ?>
                    <form action="/barang/<?php echo e($barang->id); ?>/keranjang" method="POST">
                        <?php echo csrf_field(); ?>
                        <button class='btn btn-primary btn-sm'>Masukkan ke Faktur</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MIDPROJECT\resources\views/user/index.blade.php ENDPATH**/ ?>