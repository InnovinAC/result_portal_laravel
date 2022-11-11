@extends('admin.layouts.layout')
@section('title', 'Change Settings')
@section('header', 'Change Settings')
@push('style')
<style>

/*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/
#upload {
    opacity: 0;
}

#upload-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
}

.image-area {
    border: 2px dashed rgba(103, 88, 88, 0.7);
    padding: 1rem;

}

.image-area::before {
    content: 'Uploaded image result';
    color: blue;
    font-weight: bold;
    text-transform: uppercase;

    text-align: center;
    font-size: 0.8rem;
    z-index: 2;
}



.image-area img {
    z-index: 2;
    position: relative;
    max-height: 300px;
}


</style>
@endpush

@push('scripts')
<script>
/*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}
    </script>
@endpush
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>

            <li class="breadcrumb-item active" aria-current="page">Change Settings</li>
        </ol>
    </nav>
@endsection

@push('style')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

@section('content')
    <form action="{{ route('change-settings') }}" method="post" enctype="multipart/form-data">
        @csrf




            <div class="row mt-4 g-5">
                <div id="wrapper" class="mb-4 border-end col-lg-6 col-xl-6">

                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Upload site logo</h4><small>Max size: 150kb (png, jpeg, jpg)</small>
                        </div>
                <div class="px-3 card-body mx-auto">

                    <!-- Upload image input-->
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                        <input id="upload" name="image" type="file" onchange="readURL(this);" class="form-control border-0">
                        <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                        <div class="input-group-append">
                            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                        </div>
                    </div>

                    <!-- Uploaded image area-->
                    <p class="font-italic text-dark text-center">The image uploaded will be rendered inside the box below.</p>
                    <div class="image-area mt-4"><img id="imageResult" src="{{ url('storage/uploads/image/logo.png') }}" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>

                </div>
            </div>
                </div>




                <div class="col-lg-6 col-xl-6">

        <div class="form-floating mb-3">

            <select class="@error('session')
            is-invalid
            @enderror
            form-select" name="session" id="">
                <option hidden>Select one</option>
                @foreach ($sessions as $session)
                <option {{ $session->id == $general->session_id ? "selected":"" }} value="{{ $session->id }}">{{ $session->name }}</option>
                @endforeach

            </select>
            <label>Current Session</label>
            @error('session')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <div class="form-floating mb-3">

            <select class="@error('term')
            is-invalid
            @enderror
            form-select" name="term" id="">
                <option hidden>Select one</option>
                @foreach ($terms as $term)
                <option {{ $term->id == $general->term_id ? "selected":"" }} value="{{ $term->id }}">{{ $term->name }}</option>
                @endforeach

            </select>
            <label>Current Term</label>
            @error('term')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-floating mb-3">

            <input class="@error('name')
            is-invalid
            @enderror
            form-control" name="name" value="{{ $general->school_name }}">
            <label>School Name</label>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-floating mb-3">

            <input class="@error('location')
            is-invalid
            @enderror
            form-control" name="location" value="{{ $general->location }}">
            <label>School Location</label>
            @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>





        <div class="form-floating mb-3">

            <select class="@error('pins')
            is-invalid
            @enderror
            form-select" name="pins" id="">


                <option {{ $general->use_pins == 'yes' ? "selected":"" }} value="yes">Yes</option>

                <option {{ $general->use_pins == 'no' ? "selected":"" }} value="no">No</option>


            </select>
            <label>Enable Scratch Card Pins</label>
            @error('term')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <button class="btn btn-animated btn-grape" type="submit">Save</button>
        </div>
                </div>

    </form>
@endsection


@push('scripts')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush
