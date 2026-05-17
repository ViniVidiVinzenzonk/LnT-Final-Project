
<?php $__env->startSection('title', 'Buat Faktur'); ?>
<?php $__env->startSection('content'); ?>
<h2>Keranjang</h2>
<div class='row'>
    <div class='col-md-7'>
        <table class='table table-bordered'>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Kuantitas</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
            <?php $total = 0; ?>
            <?php $__currentLoopData = $keranjang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $subtotal = $item['harga_satuan'] * $item['kuantitas']; $total += $subtotal; ?>
            <tr>
                <td><?php echo e($item['nama_barang']); ?></td>
                <td><?php echo e($item['kategori']); ?></td>
                <td>Rp. <?php echo e(number_format($item['harga_satuan'], 0, ',', '.')); ?></td>
                <td>
                    <form action="/keranjang/<?php echo e($id); ?>/update" method="POST" style="display:flex; gap:5px;">
                        <?php echo csrf_field(); ?>
                        <input type="number" name="kuantitas" value="<?php echo e($item['kuantitas']); ?>"
                               min="1" class='form-control form-control-sm' style='width:65px;'>
                        <button class='btn btn-sm btn-primary'>ok</button>
                    </form>
                </td>
                <td>Rp. <?php echo e(number_format($subtotal, 0, ',', '.')); ?></td>
                <td>
                    <form action="/keranjang/<?php echo e($id); ?>/hapus" method="POST">
                        <?php echo csrf_field(); ?>
                        <button class='btn btn-danger btn-sm'>x</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="4" class='text-end'><strong>Total</strong></td>
                <td colspan="2"><strong>Rp. <?php echo e(number_format($total, 0, ',', '.')); ?></strong></td>
            </tr>
        </table>
        <a href="/barang" class='btn btn-secondary btn-sm'>Lanjut Belanja</a>
    </div>

    <div class='col-md-5'>
        <h5>Data Pengiriman</h5>
        <form action="/faktur/simpan" method="POST">
            <?php echo csrf_field(); ?>
            <div class='mb-3'>
                <label class='form-label'>Alamat Pengiriman</label>
                <textarea name="alamat_pengiriman" class='form-control' rows="3"><?php echo e(old('alamat_pengiriman')); ?></textarea>
                <small class='text-muted'>min 10, max 100 huruf</small>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Kode Pos</label>
                <input type="text" name="kode_pos" class='form-control' value='<?php echo e(old("kode_pos")); ?>' maxlength="5">
                <small class='text-muted'>5 digit angka</small>
            </div>
            <button class='btn btn-primary'>Buat Faktur</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MIDPROJECT\resources\views/user/faktur/create.blade.php ENDPATH**/ ?>