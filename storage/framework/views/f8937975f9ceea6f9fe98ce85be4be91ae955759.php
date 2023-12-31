<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('header', 'Dashboard'); ?>
<?php $__env->startPush('style'); ?>
<style>
    #form1 {
        display: none
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">

        <!-- Dashboard Row Start -->
        <div class="gy-4 mb-5 gx-4 row">

            <!-- Column for Registered Students Start -->
            <div class="col-sm-6 col-lg-4 col-md-6">
                <div class="border-secondary border border-1 animate__animated animate__zoomIn shadow card">


                    <div class="card-body">

                        <h5 class="card-title">

                            <span class="name text-16 text-muted"><small>TOTAL STUDENTS</small></span>
                            <br>
                            <span class="font-weight-bolder text-24 text-dark"><?php echo e($students_count); ?></span>

                            <!-- <span class="text-indigo-dark mb-2 ml-2 bg-icon"><i class="fa-light fa-user"></i></span> -->
                        </h5>
                        <hr class="bg-success">
                        <a class=" card-link" href="<?php echo e(route('students')); ?>"><small>Manage</small></a> <a class="card-link "
                            href="<?php echo e(route('create-student')); ?>"><small>Add New</small></a>
                    </div>

                </div>
            </div>
            <!-- Column for Registered Students End -->


            <!-- Column for Total Subjects Start -->



            <?php if($is_admin): ?>
            <div class="col-sm-6 col-lg-4 col-md-6">
                <div class="border-secondary border border-1 animate__animated animate__zoomIn shadow card">


                    <div class="card-body">
                        <h5 class="card-title">

                            <span class="text-16 text-muted name"><small>TOTAL SUBJECTS</small></span>
                            <br>
                            <span class="font-weight-bolder text-24"><?php echo e($subjects_count); ?></span>


                        </h5>
                        <hr class="bg-vermillion">
                        <a class="card-link" href="<?php echo e(route('subjects')); ?>"><small>Manage</small></a> <a class="card-link"
                            href="<?php echo e(route('create-subject')); ?>"><small>Add New</small></a>

                    </div>
                </div>
            </div>
            <!-- Column for Total Subjects End -->


            <div class="col-sm-6 col-lg-4 col-md-6">
                <div class="border-secondary border border-1 animate__animated animate__zoomIn shadow card">

                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="text-muted text-16 name"><small>TOTAL SUBJECT COMBINATIONS</small></span>
                            <br>
                            <span class="text-24"><?php echo e($subject_combos_count); ?></span>


                        </h5>
                        <hr class="bg-navy">
                        <a class="card-link" href="<?php echo e(route('subject-combos')); ?>"><small>Manage</small></a> <a
                            class="card-link" href="<?php echo e(route('create-subject-combo')); ?>"><small>Add New</small></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-md-6">
                <div class="border-secondary border border-1 animate__animated animate__zoomIn shadow card">

                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="text-16 text-muted name"><small>NUMBER OF SESSIONS</small></span>
                            <br>
                            </i></span>
                            <span class="text-24 font-weight-bolder"><?php echo e($sessions_count); ?></span>
                        </h5>
                        <hr class="bg-orange">
                        <a class="card-link" href="<?php echo e(route('sessions')); ?>"><small>Manage</small></a> <a class="card-link"
                            href="<?php echo e(route('create-session')); ?>"><small>Add New</small></a>

                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-md-6">
                <div class="border-secondary border border-1 animate__animated animate__zoomIn shadow card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="text-16 text-muted name"><small>TOTAL TEACHER ACCOUNTS</small></span>
                            <br>
                            <span class="text-24 font-weight-bolder"><?php echo e($teachers_count); ?></span>

                        </h5>
                        <hr>
                        <a class="card-link" href="<?php echo e(route('teachers')); ?>"></small>Manage</small></a> <a class="card-link"
                            href="<?php echo e(route('create-teacher')); ?>"><small>Add New</small></a>
                    </div>
                </div>
            </div>

            <?php endif; ?>











            <div class="col-sm-6 col-lg-4 col-md-6">
                <div class="border-secondary border border-1 animate__animated animate__zoomIn shadow card">

                    <div class="card-body">
                        <h5 class="card-title">

                            <span class="text-muted text-16 name"><small>PUBLISHED RESULTS</small></span>
                            <br>
                            <span class="text-24 font-weight-bolder"><?php echo e($results_count); ?></span>


                        </h5>
                        <hr class="bg-muted">
                        <a class="card-link" href="<?php echo e(route('results')); ?>"></small>Manage</small></a> <a class="card-link"
                            href="<?php echo e(route('create-result')); ?>"><small>Add New</small></a>

                    </div>
                </div>
            </div>









        </div>


        <div class="row gx-3">


            <div class="col-sm-6">
        <div class="border border-2 rounded p-2">
            <i class="fa-light text-vermillion fa-info-circle"></i> &nbsp;<a class="text-primary text-decoration-none"
                href="https://wa.me/2348054841869">Click to report an issue/make a request</a>.
        </div>
            </div>

            <?php if(auth()->user()->role == 1): ?>
            <div class="col-sm-6">
                <div class="border border-2 rounded p-2">
                    <i class="fa-light text-vermillion fa-info-circle"></i> &nbsp;<a href="#form1" id="formButton"
                        class=" text-decoration-none text-primary">Click here to quickly check a student's result</a>.
                </div>
                    </div>

        </div>


        <div class="container mt-4  mb-4" id="form1">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-title text-center">
                        <p class="h3 text-muted font-weight-bold mb-2">Result Checker</p>
                    </div>
                    <form class="form-floating" action="<?php echo e(route('result')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4 form-floating">
                            <input type="text" class="
                            <?php $__errorArgs = ['regnum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            is-invalid
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control" id="regnum" required="required"
                                placeholder="Enter Your Reg Number" autocomplete="on" name="regnum">
                            <label for="regnum">Registration Number:</label>
                        </div>
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


                        <div class="form-floating mb-4">

                            <select name="class" class="form-select" id="Class" required>
                                <option value="" disabled selected hidden>-- Select --</option>
                                <?php $__currentLoopData = $school_classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school_class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($school_class->id); ?>"><?php echo e($school_class->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                            </select>
                            <label for="Class">Class:</label>
                        </div>
                        <div class="mb-4 form-floating">
                            <select name="term" class="form-select" id="term" required>
                                <option value="" disabled selected hidden>Select Term</option>
                                <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($term->id); ?>"><?php echo e($term->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                            <label for="term">Term:</label>
                        </div>
                        <div class="form-floating mb-4">

                            <select name="session" class="form-select" id="session" required>
                                <option disabled selected hidden value="">Select Academic Session</option>

                                <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($session->id); ?>"><?php echo e($session->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                            <label for="session">Academic Session:</label>
                        </div>
                        <?php if($general->use_pins == 'yes'): ?>

                        <div class="mb-4 form-floating">
                            <input type="hidden" class="
                            <?php $__errorArgs = ['pin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            is-invalid
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form-control" id="pin" required="required"
                                placeholder="Enter Your Pin" autocomplete="on"  name="pin" value="1@%@!seCRetPin$topSECreT#&hidDeN@#" readonly>
                            <label for="pin">Pin</label>
                        </div>
                        <?php $__errorArgs = ['pin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <?php endif; ?>


                        <div class="form-group mb-4">

                            <button type="submit" class="btn btn-primary float-right">Check Result</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <?php else: ?>
    </div>

    <?php endif; ?>




    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $("#formButton").click(function() {
            $("#form1").toggle();
        });
        $("#smile").click(function() {
            $("#smile").toggleClass("fa-smile fa-laugh");
            $("#smile").toggleClass("fa-rotate-0 fa-rotate-45");
        });
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/innovin/Documents/projects/result_portal_laravel/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>