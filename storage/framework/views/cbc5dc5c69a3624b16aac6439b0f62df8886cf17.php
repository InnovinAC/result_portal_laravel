<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $__env->yieldContent('title'); ?> > <?php echo e($general->school_name); ?> </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf_token" content="<?php echo e(csrf_token()); ?>">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fontawesome/css/all.min.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
        media="all">




    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-colors.css')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/additional.css')); ?>" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* ============ desktop view ============ */
        @media all and (min-width: 992px) {
            .navbar .nav-item .dropdown-menu {
                display: none;
            }

            .navbar .nav-item:hover .nav-link {}

            .navbar .nav-item:hover .dropdown-menu {
                display: block;
            }
        }

        /* ============ desktop view .end// ============ */


        button.navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
            background-image: none;
        }

        button.navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before {
            content: "\58";
            line-height: 2rem;
        }
    </style>
    <?php echo $__env->yieldPushContent('style'); ?>
    <!-- End Stylesheets -->

    <!-- Favicon -->

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
        <?php if($general->use_pins == 'no' && Auth::guard('web')->user()->role == 1): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong><i class="fa-regular fa-warning"></i> Be Aware.</strong> Pins are currently disabled. Please <a
                    href="<?php echo e(route('change-settings')); ?>" class="alert-link">Go Here</a> to enable it.
            </div>
        <?php endif; ?>
        <div
            class="card border-2 border-success animate__animated animate__lightSpeedInRight animate__faster border shadow mb-5">
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
                    <?php if (! empty(trim($__env->yieldContent('multi-select')))): ?>
                        <div class="mb-2 d-md-none d-print-none alert alert-primary">The table below can be scrolled
                            from left to right on
                            smaller screens.</div>
                        <form id="multi-delete-form" action="<?php echo $__env->yieldContent('multi-select'); ?>" method="post">
                            <?php echo csrf_field(); ?>
                    <?php endif; ?>
                    <?php if (! empty(trim($__env->yieldContent('add-url')))): ?>
                        <div class="mb-3">

                            <a class="btn btn-primary " href="<?php echo $__env->yieldContent('add-url'); ?>"><i class="fal fa-plus-circle"></i> Add
                                New</a>

                            
                        </div>
                    <?php endif; ?>
                    <?php echo $__env->yieldContent('content'); ?>
                <?php else: ?>
                    <?php echo $__env->yieldContent('content'); ?>

    <?php endif; ?>


    <?php if(!request()->is('admin')): ?>
        <?php if (! empty(trim($__env->yieldContent('multi-select')))): ?>
            <br>
            <i class="fa-light fa-2x fa-level-up-alt fa-flip-horizontal"></i> <input type="checkbox" id="checkAll">
            <label for="checkAll" class="control-label">Check All</label> <em class="m-4">With Selected:</em>
            &nbsp;&nbsp; <button type="button" id="multi-delete-button" class="btn btn-sm btn-vermillion"
                class="text-vermillion"><i class="fa-light fa-trash-alt"></i> Delete</button>

            </form>
        <?php endif; ?>
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

    <script>
        $("#toggler-icon").click(function(e) {

            e.stopPropagation()
            $(this).toggleClass("fa-bars fa-times");

        })
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


    <?php if (! empty(trim($__env->yieldContent('multi-select')))): ?>
        <script>
            // listen for clicks on toggle checkbox
            $('#checkAll').click(function(event) {
                if (this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });
        </script>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>


    <?php if (! empty(trim($__env->yieldContent('multi-select')))): ?>
        <script>
            $(document).ready(function() {

                $('#multi-delete-button').click(function() {
                    const item = '<?php echo $__env->yieldContent('itemName'); ?>'
                    const count = document.querySelectorAll('.checkItem:checked').length
                    console.log(count)


                    if (count > 0) {

                        Swal.fire({

                                title: 'Please confirm',
                                html: `Are you sure you want to delete these <b>${count}</b> ${item}(s).`,
                                icon: 'warning',
                                showCancelButton: 'true'

                            })
                            .then((result) => {
                                if (result.value) {
                                    $('#multi-delete-form').submit()
                                }
                            })

                    } else {

                        Swal.fire({
                            title: '<strong>No!</strong>',
                            text:`You must select at least one ${item}.`,
                            icon: 'error',
                            confirmButtonColor: 'blue'
                        })

                    }
                })
            })
        </script>
    <?php endif; ?>
    <!-- End Javascript -->

</body>






<?php echo $__env->make('admin.partials.toast', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</html>
<?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/admin/layouts/layout.blade.php ENDPATH**/ ?>