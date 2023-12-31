
<style>
    #wrapper {
        text-align: center;
        margin: 0 auto;
        padding: 0px;
        width: 995px;
    }

    #output_image {
        max-width: 100px;
    }
</style>







<form id="edit" action="<?php echo e(route('edit-student', $student->id)); ?>" enctype="multipart/form-data"
method="POST">
                <?php echo csrf_field(); ?>
                <div id="wrapper mb-4">
                    <div class="mb-3">

                        <label for="image" class="form-label">Change Student Image</label>
                        <input onchange="preview_image(event)" type="file" class="form-control" name="image"
                            id="image" placeholder="" aria-describedby="fileHelpId">


                    </div>
                    <a href="<?php echo e(url('storage/uploads/students/' . $student->image)); ?>" data-fancybox
                        data-caption="<?php echo e($student->name); ?>">
                        <img style="max-width: 300px" src="<?php echo e(url('storage/uploads/students/' . $student->image)); ?>"
                            class="mb-4 border border-primary p-2 border-2 d-flex mx-auto" id="output_image" />
                    </a>

                </div>




                <div class="form-floating mb-3">
                    <input value="<?php echo e($student->name); ?>" type="text"
                        class="<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control" name="name"
                        id="name" placeholder="">
                    <label for="name">Full Name <span class="text-vermillion">*</span></label>
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



                <div class="form-floating mb-3">
                    <input value="<?php echo e($student->regnum); ?>" type="text"
                        class="<?php $__errorArgs = ['regnum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              is-invalid
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control"
                        name="regnum" id="regnum" placeholder="">
                    <label for="regnum">Registration Number</label>
                    <?php $__errorArgs = ['regnum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__errorArgs = ['image'];
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


                <div class="mb-4 form-floating">

                    <select name="class"
                        class="<?php $__errorArgs = ['class'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            is-invalid
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-select" id="class"
                        required="required">
                        <option value="" hidden selected>Select Class</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>"
                                <?php echo e($class->id == $student->schoolClass->id ? 'selected' : ''); ?>><?php echo e($class->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                    <label for="class">Class</label>
                    <?php $__errorArgs = ['class'];
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
                    <input value="<?php echo e($student->date_of_birth); ?>" type="date"
                        class="<?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  is-invalid
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control"
                        name="dob" id="dob" placeholder="">
                    <label for="dob">Date Of Birth</label>
                    <?php $__errorArgs = ['dob'];
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







                <h6>Gender <span class="text-vermillion">*</span></h6>
                <div
                    class="form-check <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            has-validation
             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-check-inline">

                    <input class="form-check-input" type="radio" name="gender" id="gender"
                        <?php echo e($student->gender == 'male' ? 'checked' : ''); ?> value="male">
                    <label class="form-check-label" for="">Male</label>
                </div>
                <div
                    class="<?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
               is-invalid
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender"
                        <?php echo e($student->gender == 'female' ? 'checked' : ''); ?> value="female">
                    <label class="form-check-label" for="">Female</label>
                </div>
                <div
                    class="<?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
               is-invalid
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-check form-check-inline">
                    <input <?php echo e($student->gender == 'other' ? 'checked' : ''); ?> required class="form-check-input"
                        type="radio" name="gender" id="gender" value="other">
                    <label class="form-check-label" for="">Other</label>


                </div>
                <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>



                <h6>Status <span class="text-vermillion">*</span></h6>
                <div
                    class="form-check <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            has-validation
             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-check-inline">

                    <input class="form-check-input" type="radio" name="status" id="status"
                        <?php echo e($student->status == 'active' ? 'checked' : ''); ?> value="active">
                    <label class="form-check-label" for="">Active</label>
                </div>
                <div
                    class="<?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
               is-invalid
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status"
                        <?php echo e($student->status == 'blocked' ? 'checked' : ''); ?> value="blocked">
                    <label class="form-check-label" for="">Blocked</label>
                </div>



                <div class="form-group mt-3">
                    
                </div>

</form>






<script type='text/javascript'>
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

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


<!-- End Javascript -->
<?php /**PATH /Users/innovin/Documents/projects/result_portal_laravel/resources/views/admin/edit/student.blade.php ENDPATH**/ ?>