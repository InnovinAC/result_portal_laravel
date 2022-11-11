
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $general->school_name }} - Admin Login</title>
      <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Stylesheets -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" media="all" >
 <link rel="stylesheet" href="{{ asset('/assets/fontawesome/css/all.min.css?2') }}" media="all" >
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" media="all">
<link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-colors.css') }}" media="all" >
<link rel="stylesheet" href="../css/additional.css" media="all" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- End Stylesheets -->

<style>
	/* Coded with love by Mutiullah Samim */
    body,
		html {
			margin: 10px;
			padding: 0;
			height: 100%;
            background: #4257cd
		}
		.user_card {
			height: 450px;
			width: 350px;
			margin-top: 100px;
			margin-bottom: auto;
			background: #fff;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: #fff;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 130px;
			width: 130px;
			border-radius: 50%;
			border: 1px solid white;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #162ba2 !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}


		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
    </style>

<!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png?v=1.2">
<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png?v=1.2">
<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png?v=1.2">
<link rel="manifest" href="../img/site.webmanifest">
<!-- End Favicon -->
     <link href="{{ asset('assets/css/additional.css') }}" rel="stylesheet" media="all" />
    </head>
<body>





        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="user_card animate__animated animate__slow animate__zoomIn">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <img src="{{ url('storage/uploads/image/logo.png') }}" class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center form_container">
                        <form action="{{ url('/admin/login') }}" method="post">
                            @csrf
                            <div class="form-floating mb-3">

                                <input
                                required
                                value="{{ old('user') }}"
                                type="text" name="user" class="form-control @error('user') is-invalid @enderror" value="" placeholder="">
                                <label>Enter Username</label>
                                @error('user')
                                <small class="text-vermillion">{{ $message }}</small>
                                @enderror

                            </div>


                            <div class="form-floating mb-2">

                                <input required autocomplete="off" type="password" name="password" class="form-control @error('password') is-invalid @enderror password" value="{{ old('password') }}" placeholder="">
                                <label>Enter Password</label>
                                @error('password')
                                <small class="text-vermillion">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                                </div>
                            </div>
                                <div class="d-flex justify-content-center mt-3 login_container">
                         <button type="submit" name="button" class="btn login_btn">Login</button>
                       </div>
                        </form>
                    </div>

                    <div class="mt-4">

                        <div class="d-flex justify-content-center links">
                            <a href="#">Forgot your password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="js/jquery-printme.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/disableautofill/src/jquery.disableAutoFill.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@include('admin.partials.toast')

<br>
<br>
              <script>  $(document).ready(function(){
$("span.toggler").click(changeClass);
 function changeClass() {
       $("#toggler-icon").toggleClass("fa-bars fa-times");
    }
    });</script>

<script>
   $(function () {
            $("#code").click(function () {
                $(this).toggleClass("bg-dark bg-white text-white text-dark border border-primary"); });
}); </script>
<script>
// prevent resubmission of data on reload
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}


$(function() {
    $('.login-form').disableAutoFill({
        passwordField: '.password'
    });
});
</script>
</div>

@include('admin.partials.footer')
    </body>
</html>
