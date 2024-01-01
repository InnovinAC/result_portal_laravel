<?php $__env->startSection('title', 'Create Subject'); ?>
<?php $__env->startSection('header', 'Create Subject'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('subjects')); ?>">Subjects</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('create-subject')); ?>"  method="POST">
        <?php echo csrf_field(); ?>

        <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($error); ?> <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <div class="form-floating mb-3">
          <input
              required
            value="<?php echo e(old('subject_name.*')); ?>"
            type="text"
            class="<?php $__errorArgs = ['subject_name.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control" name="subject_name[]" id="name" placeholder="">
          <label for="name">Subject Name <span class="text-vermillion">*</span></label>
          <?php $__errorArgs = ['subject_name.*'];
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

        <div id="newSubjects" class="row gap-3">
        </div>

               <div class="form-group mt-3">
               <button type="submit" class="btn btn-primary">Submit</button>
               <a class="btn btn-brown" id="new"><i class="fa-light fa-plus-circle"></i></a>
               </div>



            </form>







<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>
        if (!window?.SubjectsCount) {
            window.SubjectsCount = 0;
        }


        $('#new').click(async function() {

            const html = `<div id="subject-${window?.SubjectsCount}" class="col-12 row"><div class="col-11"><div class="form-floating">` +
                '<input required value="" type="text" class="' + 'form-control" name="subject_name[]" ' + 'id="name" placeholder="">' +
            `<label for="name">Subject Name <span class="text-vermillion">*</'+ 'span></label></div></div><a id="subject-${window?.SubjectsCount}-remover" class="btn d-flex flex-column justify-content-center btn-danger col-1 align-items-center" id="new"><i class="fa-light fa-minus-circle"></i></a></div>`;
            $('#newSubjects').append(html);
            const count = window.SubjectsCount;
            $(`#subject-${count}-remover`).on('click', (e) => {
                $(`#subject-${count}`).fadeOut(300, function() {this.remove();});
            })
            window.SubjectsCount++;
        });


        </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/innovin/Documents/projects/result_portal_laravel/resources/views/admin/create/subject.blade.php ENDPATH**/ ?>