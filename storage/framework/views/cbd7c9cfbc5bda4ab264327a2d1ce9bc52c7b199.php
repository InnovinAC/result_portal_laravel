<?php $__env->startSection('title', 'Promote Students'); ?>
<?php $__env->startSection('header', 'Promote Students'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Promote</li>
    </ol>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <strong>NB:</strong> The process of mass promoting students cannot be undone. In order to change a particular student's class. Please go to the <a class="alert-link" href="<?php echo e(route('students')); ?>">List of students</a> and change the particular student's class.
</div>

<form action="<?php echo e(route('promote')); ?>" method="post">
    <?php echo csrf_field(); ?>

    <button onclick="return confirm('Are you sure you want to promote all students to the next class?')" class="btn btn-primary">Mass Promote Students</button>




</form>






<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/admin/promote.blade.php ENDPATH**/ ?>