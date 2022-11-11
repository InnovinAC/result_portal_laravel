<!DOCTYPE html>
<html lang="en">

<head>
    <title>Results Portal - Woodsgate International School</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fontawesome/css/all.min.css')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-colors.css')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/additional.css')); ?>" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <!-- End Stylesheets -->

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png?v=1.2">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png?v=1.2">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png?v=1.2">
    <link rel="manifest" href="../img/site.webmanifest">
    <!-- End Favicon -->

    <link rel="me" name="Innovin Anuonye" href="https://wa.me/2348054841869">

</head>

<body class="bg-white">

    <div class="mt-3 container-sm bg-white">

        <img src="./../img/logo.png" class="mx-auto d-flex" width="120">

        <p class="h3 text-muted font-weight-bold text-center">How To Check Your Result.</p>
        <ol class="h5">
            <li>Input the registration number assigned to you by your form-teacher in the first box.</li>
            <li>Select your class from the dropdown menu(also select the term of choice).</li>
            <li>Click on "Check Result".</li>
            <li>After that, your result will be displayed after which you can proceed to print it.</li>
        </ol>
        <p class="h4">Having Issues? <a class="text-underline text-underline-blue text-danger"
                href="../index.php#contactUs">Contact Us</a>.</p>
        <hr>
        <div id="result-checker" class="mt-2 card mb-50 shadow-sm" style="width:100%">
            <div class="card-body">
                <div class="card-title text-center">
                    <p class="h2 text-muted font-weight-bold mb-2">Result Checker</p>
                </div>
                <form class="form-floating" action="result" method="post">

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="mb-4 form-floating">
                                <input type="text" class="form-control" id="regnum" required="required"
                                    placeholder="Enter Your Reg Number" autocomplete="on" name="regnum">
                                <label for="regnum">Registration Number:</label>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-4 form-floating">
                                <input type="text" class="form-control" id="pin" required="required"
                                    placeholder="Enter Your Pin" autocomplete="on" name="pin">
                                <label for="pin"> Pin:</label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-4 form-floating">

                                <select name="class" class="form-select" id="class" required>
                                    <option value="" disabled selected hidden>Select Class</option>
                                    <option value="1">Nursery 1</option>
                                    <option value="2">Nursery 2</option>
                                    <option value="3">Nursery 3</option>
                                    <option value="4">Primary 1</option>
                                    <option value="5">Primary 2</option>
                                    <option value="6">Primary 3</option>
                                    <option value="7">Primary 4</option>
                                    <option value="8">Primary 5</option>
                                    <option value="9">Primary 6</option>
                                    <option value="10">JSS1</option>
                                    <option value="11">JSS2</option>
                                    <option value="12">JSS3</option>
                                    <option value="13">SS1</option>
                                    <option value="14">SS2</option>
                                    <option value="15">SS3</option>
                                </select>
                                <label for="class">Class:</label>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-4 form-floating">

                                <select name="term" class="form-select" id="term" required>
                                    <option value="" disabled selected hidden>Select Term</option>
                                    <option value="1">1st Term</option>
                                    <option value="2">2nd Term</option>
                                    <option value="3">3rd Term</option>
                                </select>
                                <label for="term">Term:</label>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-4 form-floating">

                                <select name="session" class="form-select" id="session" required>
                                    <option disabled selected hidden value="">Select Academic Session</option>
                                    <option value="1">2019/2020</option>
                                    <option value="2">2020/2021</option>
                                </select>
                                <label for="session">Academic Session:</label>
                            </div>
                        </div>


                        <div class="form-group mt-4">

                            <button type="submit" class="btn btn-lg mx-auto d-flex btn-primary float-right">Check
                                Result</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
<a class="pb-4 text-underline text-green mx-3 text-center" href="./../index.php">Click here to return to main
    website</a>
<br>
<div class="border-top">
    <p class="my-3 text-center">
        Web Design By <a href="https://wa.me/2348054841869">Innovin Anuonye</a> | A Product Of ICK Optimum Services
        Nig. Ltd.</p>
</div>

</html>
<?php /**PATH C:\xampp\htdocs\result_laravel\resources\views\check-result.blade.php ENDPATH**/ ?>