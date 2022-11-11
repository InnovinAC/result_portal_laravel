<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e($general->school_name); ?> </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf_token" content="<?php echo e(csrf_token()); ?>">


    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fontawesome/css/all.min.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" media="all">




    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-colors.css')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/additional.css')); ?>" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php echo $__env->yieldPushContent('style'); ?>
    <!-- End Stylesheets -->

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png?v=1.2">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png?v=1.2">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png?v=1.2">
    <link rel="manifest" href="../img/site.webmanifest">
    <!-- End Favicon -->


</head>

<body class="bg-white">
    <?php echo $__env->make('admin.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- Enable JS -->
    <noscript>
        <br>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <b>
                    <i class="fa-light fa-info-circle"></i> Please enable JavaScript on your browser to avoid issues
                    while using this software. </b>
            </div>
        </div>
    </noscript>
    <!-- End Enable JS -->


    <div class="container mt-4">
        <div class="card border-2 border-success animate__animated animate__lightSpeedInRight animate__faster border shadow mb-5">
            <div class="card-body">

                <div class="text-left my-1">

                    <h3 class="text-muted font-bold"><?php echo $__env->yieldContent('header'); ?></h3>



                    <?php echo $__env->yieldContent('breadcrumbs'); ?>

                </div>
            </div>
        </div>
    </div>

    
    <?php if(!request()->is('admin')): ?>
        <div class="container">
            <div class="card border border-2 shadow">
                <div class="card-body">
                    <?php if (! empty(trim($__env->yieldContent('add-url')))): ?>
                    <div class="mb-3">

                        <a class="btn btn-primary " href="<?php echo $__env->yieldContent('add-url'); ?>"><i
                                class="fal fa-plus-circle"></i> Add New</a>

                                    
                                </div>




    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>

    <?php else: ?>
    <?php echo $__env->yieldContent('content'); ?>

    <?php endif; ?>


    <?php if(!request()->is('admin')): ?>
        </div>
        </div>
        </div>

    <?php endif; ?>









    </div>




    <!-- Start Javascript -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?php echo e(asset('assets/js/jquery-printme.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $("span.toggler").click(changeClass);

            function changeClass() {
                $("#toggler-icon").toggleClass("fa-bars fa-times");
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tableData').DataTable();



            $("#printabl").click(function() {
                $("#printable").printMe({
                    "path": [
                        "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css",
                        "<?php echo e(asset('assets/fontawesome/css/all.min.css')); ?>",
                        "https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css",
                        "<?php echo e(asset('assets/css/additional.css')); ?>",
                        "<?php echo e(asset('assets/css/bootstrap-colors.css')); ?>"
                    ]
                });
            });
        });
    </script>

    <script>
        $(function() {
            $("#code").click(function() {
                $(this).toggleClass("bg-dark bg-white text-white text-dark border border-primary");
            });
        });
    </script>
    <script>
        // prevent resubmission of data on reload
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <!-- End Javascript -->

</body>






<?php echo $__env->make('admin.partials.toast', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</html>
<?php /**PATH C:\xampp\htdocs\result_laravel\resources\views\admin\layouts\layout.blade.php ENDPATH**/ ?>