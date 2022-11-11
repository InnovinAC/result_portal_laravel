<?php $__env->startSection('title', 'Create Pins'); ?>
<?php $__env->startSection('header', 'Create Pins'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('pins')); ?>">Pins</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('create-pin')); ?>">
        <?php echo csrf_field(); ?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    <strong>NB!</strong> You are only allowed to <br>
    <ul>
    <li>create a maximum of 500 pins at the same time</li>
    <li>have a maximum of 10 character pins</li>
    <li>have a minimum of 3 pin trials</li>
    <hr>
    The process might take as much as 5 seconds.
</div>

        <div class="form-floating mb-3">
          <input max="500"
            type="number"
            class="<?php $__errorArgs = ['count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            form-control" name="count" id="count" required placeholder="">
          <label for="floatingLabel">Number of Pins To Generate</label>
          <?php $__errorArgs = ['count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>


        <div class="form-floating mb-3">
            <input
              type="number"
              class="<?php $__errorArgs = ['characters'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              is-invalid
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              form-control" required name="characters" id="characters" placeholder="">
            <label for="floatingLabel">Number of Pins Characters</label>
            <?php $__errorArgs = ['characters'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>


          <div class="form-floating mb-3">
            <input
            min="3"
              type="number"
              class="<?php $__errorArgs = ['trials'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              form-control" required name="trials" id="trials" placeholder="">
            <label for="floatingLabel">Number of Pins Trials</label>
            <?php $__errorArgs = ['trials'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>


          <button class="btn btn-primary" type="submit">Add</button>




    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $('#count').on('keyup keydown change', function(e){
    console.log($(this).val() > 500)
        if ($(this).val() > 500
            && e.keyCode !== 46
            && e.keyCode !== 8
           ) {
           e.preventDefault();
           $(this).val(500);
        }
    });


    $('#characters').on('keyup keydown change', function(e){
    console.log($(this).val() > 10)
        if ($(this).val() > 10
            && e.keyCode !== 46
            && e.keyCode !== 8
           ) {
           e.preventDefault();
           $(this).val(10);
        }
    });


    // $('#trials').on('keyup keydown change', function(e){
    // console.log($(this).val() < 3)
    //     if ($(this).val() < 3
    //         && e.keyCode !== 46
    //         && e.keyCode !== 8
    //        ) {
    //        e.preventDefault();
    //        $(this).val(3);
    //     }
    // });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\result_laravel\resources\views\admin\create\pin.blade.php ENDPATH**/ ?>