<?php
    $keys = ['error', 'info', 'success', 'warning'];
?>

<?php $__currentLoopData = $keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(session()->has($key)): ?>

<script>
    iziToast.<?php echo e($key); ?>({
message: '<?php echo session($key); ?>',
position: 'topRight'
});
    </script>


<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH /Users/innovin/Documents/projects/result_portal_laravel/resources/views/admin/partials/toast.blade.php ENDPATH**/ ?>