<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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

    <!-- End Stylesheets -->


    <title>My Result Details - Woodsgate International School</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



    <!-- Favicon -->

    <!-- End Favicon -->

    <link rel="developer" description="Innovin Anuonye" href="https://wa.me/2348054841869">



</head>

<body class="mb-4">

    <div class="container-fluid">
        <section class="mt-4 section" id="printable">

            <div class="shadow mx-2 card">



                <div class="card-header border-2 border-bottom bg-white">

                    <div class="row">

                        <div class="col-12 col-lg-4">

                            <img src="<?php echo e(url('storage/uploads/image/logo.png')); ?>" class="d-flex mx-auto mb-2"
                                width="100" height="100">
                        </div>
                        <div class="col-12 col-lg-4">


                            <h3 class="text-center font-weight-bolder  text-22 text-lb"><?php echo e($general->school_name); ?>

                            </h3>
                            <h5 class="mb-2 text-26 text-center my-0"><?php echo e($general->location); ?>

                                .</h5>
                            <h6 class="text-lb text-18 text-center font-weight-bold my-0">STUDENT TERMINAL REPORT</h6>
                        </div>

                        <div class="col-12 col-auto col-lg-4">

                            <img src="<?php echo e(url('storage/uploads/students/' . $result->student->image)); ?>"
                                class="d-flex mx-auto mb-2" width="100" height="100">
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row gx-3">

                            <div class="col-6">
                                <table class="table table-sm table-hover table-bordered table-striped" border=""
                                    cellspacing="0">
                                    <!--
<img style="display: block;border:1px solid grey;margin-left: auto;margin-top:4px;margin-buttom:4px;margin-right: auto;" width="200" class=" border my-4 rounded d-flex mx-auto img-fluid" src="students/"> -->


                                    <tbody>
                                        <tr>
                                            <td><strong>Student Name</strong></td>
                                            <td><?php echo e($result->student->name); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Registration Number</strong></td>
                                            <td><?php echo e($result->student->regnum); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gender</strong></td>
                                            <td><?php echo e(ucfirst($result->student->gender)); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-6">
                                <table class="table table-hover table-bordered table-striped" border=""
                                    width="100%" cellspacing="0">

                                    <tr>
                                        <td><strong>Class</strong></td>
                                        <td><?php echo e($result->schoolClass->name); ?></td>
                                    </tr>
                                    <tr style="background-color:#87ceeb">
                                        <td><strong>Term</strong></td>
                                        <td><?php echo e($result->term->name); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Academic Session</strong></td>
                                        <td><?php echo e($result->session->name); ?></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <br>



                        <div class="row gx-3">

                            <div class="col-8">
                                <div class="table-responsive">
                                    <table
                                        class="bg-white table-sm table table-responsive-md table-striped table-hover table-bordered"
                                        border="" cellspacing="0">
                                        <thead class="">
                                            <tr class="" style="text-align: center">
                                                <!--  <th class="border-primary" style="text-align: center">S/N</th> -->
                                                <th class="text-16 bg-success text-white font-weight-bold"
                                                    style="text-align: center"> SECTION A(Academic Report)</th>
                                                <th style="text-align: center">C.A.T(40)</th>
                                                <th style="text-align: center">Exam(60)</th>
                                                <th style="text-align: center">Total(100)</th>
                                                <th style="text-align: center">Grade</th>
                                                <th style="text-align: center">Remark</th>

                                            </tr>
                                        </thead>




                                        <tbody class="">
                                            <?php for($i = 0; $i < $subjects->count(); $i++): ?>
                                                <tr>
                                                    <!-- <td style="text-align: center">1</td> -->
                                                    <td style="text-align: center"><?php echo e($subjects[$i]->name); ?></td>
                                                    <td style="text-align: center"><?php echo e($scores[$i][0]); ?></td>
                                                    <td style="text-align: center"><?php echo e($scores[$i][1]); ?></td>

                                                    <td style="text-align: center">
                                                        <?php echo e($scores[$i][0] + $scores[$i][1]); ?></td>
                                                    <td style="text-align: center">C </td>
                                                    <td style="text-align: center">Good</td>
                                                </tr>
                                            <?php endfor; ?>

                                            <tr>
                                                <th scope="row" colspan="5" style="text-align: center">Total
                                                    Marks</th>
                                                <td style="text-align: center"><b><?php echo e($total); ?></b> out of
                                                    <b><?php echo e($out_of); ?></b></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="5" style="text-align: center">Average
                                                </th>
                                                <td style="text-align: center"><b><?php echo e($result->average); ?> %</b></td>
                                            </tr>

                                            <tr>
                                                <th scope="row" colspan="5" style="text-align: center">Grade
                                                </th>
                                                <td style="text-align: center"><b>
                                                        C <?php echo e($position_in_class); ?>

                                                    </b></td>


                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="5" style="text-align: center">
                                                    Teacher's
                                                    Comment</th>

                                                <td style="text-align: center"><?php echo e($result->comment); ?></td>
                                            </tr>



                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered">
                                        <!-- I did not use <thead></thead> so it would not affect how the print out looks like -->
                                        <tbody>
                                            <tr>
                                                <th class="text-center" colspan="6">SECTION B<br>
                                                    EFFECTIVE(Character & Behaviour)</th>
                                            </tr>

                                            <tr>
                                                <th></th>
                                                <th>A</th>
                                                <th>B</th>
                                                <th>C</th>
                                                <th>D</th>
                                                <th>E</th>
                                            </tr>

                                        </tbody>
                                        <tbody>

                                            <tr>
                                                <td>Punctuality</td>
                                                <td></td>
                                                <td><i class="fa-regular fa-check-circle text-success"></i></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Attendance</td>
                                                <td></td>
                                                <td></td>
                                                <td><i class="fa-light fa-check-circle"></i></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Assignment</td>
                                                <td></td>
                                                <td></td>
                                                <td><i class="fa-light fa-check-circle"></i></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Neatness</td>
                                                <td></td>
                                                <td><i class="fa-light fa-check-circle"></i></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Honesty</td>
                                                <td></td>
                                                <td><i class="fa-light fa-check-circle"></i></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Composure</td>
                                                <td></td>
                                                <td></td>
                                                <td><i class="fa-light fa-check-circle"></i></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Game/Sports</td>
                                                <td></td>
                                                <td><i class="fa-light fa-check-circle"></i></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Relating With Others</td>
                                                <td></td>
                                                <td></td>
                                                <td><i class="fa-light fa-check-circle"></i></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Self Control</td>
                                                <td></td>
                                                <td><i class="fa-light fa-check-circle"></i></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Helping Others</td>
                                                <td></td>
                                                <td><i class="fa-light fa-check-circle"></i></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
        </section>
        <div id="printabl" class="btn mt-3 btn-primary">
            <i class="fa-light fa-print" aria-hidden="true" style="cursor:pointer"> Print</i>
        </div>
        <a class="btn btn-success mt-2" href="<?php echo e(route('check-result')); ?>">Back Home</a>
    </div>
    <?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
        $(document).ready(function() {
            $("span.toggler").click(changeClass);

            function changeClass() {
                $("#toggler-icon").toggleClass("fa-bars fa-times");
            }
        });
    </script>

    <script>
        $(document).ready(function() {


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


    <?php if($general->use_pins == 'yes'): ?>
    <script>
        let usages = "<?php echo e($trials_left); ?>";
        iziToast.info({
            message: 'You have <b> ' + usages + ' </b> usages left for this pin. ',
            position: 'topRight'
        });
    </script>
    <?php endif; ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/result.blade.php ENDPATH**/ ?>