

<hehehe>
<form id='edit' action="<?php echo e(route('edit-subject', $subject->id)); ?>"  method="POST">
    <?php echo csrf_field(); ?>

    <div class="form-floating mb-3">
        <input
          value="<?php echo e($subject->name); ?>"
          type="text"
          class="<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          is-invalid
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control" name="name" id="name" placeholder="">
        <label for="name">Subject Name <span class="text-vermillion">*</span></label>
        <?php $__errorArgs = ['name'];
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


     </form>

     <script>
        $('#submit').click(function () {
            let counter = 0
            let text = ['loading.', 'loading..', 'loading...', 'loading.', 'loading..', 'loading...']
            const change = () => {
                $('#submit').text(text[counter])
                counter ++
            }
            setInterval(change, 250);
            setTimeout(() => {
                $('#edit').submit()
            }, 1000)

        })

    </script>



<?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/admin/edit/subject.blade.php ENDPATH**/ ?>