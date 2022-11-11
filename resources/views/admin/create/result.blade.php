@extends('admin.layouts.layout')
@section('title', 'Create Results')
@section('header', 'Create Results')

@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('results') }}">Results</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #overlay{display: block}.cssload-fond{display: none;position: relative;margin: auto}.cssload-container-general{animation: cssload-animball_two 1.15s infinite;-o-animation: cssload-animball_two 1.15s infinite;-ms-animation: cssload-animball_two 1.15s infinite;-webkit-animation: cssload-animball_two 1.15s infinite;-moz-animation: cssload-animball_two 1.15s infinite;width: 40px;height: 40px}.cssload-internal{width: 40px;height: 40px;position: absolute}.cssload-ballcolor{width: 18px;height: 18px;border-radius: 50%}.cssload-ball_1,.cssload-ball_2,.cssload-ball_3,.cssload-ball_4{position: absolute;animation: cssload-animball_one 1.15s infinite ease;-o-animation: cssload-animball_one 1.15s infinite ease;-ms-animation: cssload-animball_one 1.15s infinite ease;-webkit-animation: cssload-animball_one 1.15s infinite ease;-moz-animation: cssload-animball_one 1.15s infinite ease}.cssload-ball_1{background-color: rgb(203, 32, 37);top: 0;left: 0}.cssload-ball_2{background-color: rgb(248, 179, 52);top: 0;left: 22px}.cssload-ball_3{background-color: rgb(0, 160, 150);top: 22px;left: 0}.cssload-ball_4{background-color: rgb(151, 191, 13);top: 22px;left: 22px}@keyframes cssload-animball_one{0%{position: absolute}50%{top: 11px;left: 11px;position: absolute;opacity: 0.5}100%{position: absolute}}@-o-keyframes cssload-animball_one{0%{position: absolute}50%{top: 11px;left: 11px;position: absolute;opacity: 0.5}100%{position: absolute}}@-ms-keyframes cssload-animball_one{0%{position: absolute}50%{top: 11px;left: 11px;position: absolute;opacity: 0.5}100%{position: absolute}}@-webkit-keyframes cssload-animball_one{0%{position: absolute}50%{top: 11px;left: 11px;position: absolute;opacity: 0.5}100%{position: absolute}}@-moz-keyframes cssload-animball_one{0%{position: absolute}50%{top: 11px;left: 11px;position: absolute;opacity: 0.5}100%{position: absolute}}@keyframes cssload-animball_two{0%{transform: rotate(0deg) scale(1)}50%{transform: rotate(360deg) scale(1.3)}100%{transform: rotate(720deg) scale(1)}}@-o-keyframes cssload-animball_two{0%{-o-transform: rotate(0deg) scale(1)}50%{-o-transform: rotate(360deg) scale(1.3)}100%{-o-transform: rotate(720deg) scale(1)}}@-ms-keyframes cssload-animball_two{0%{-ms-transform: rotate(0deg) scale(1)}50%{-ms-transform: rotate(360deg) scale(1.3)}100%{-ms-transform: rotate(720deg) scale(1)}}@-webkit-keyframes cssload-animball_two{0%{-webkit-transform: rotate(0deg) scale(1)}50%{-webkit-transform: rotate(360deg) scale(1.3)}100%{-webkit-transform: rotate(720deg) scale(1)}}@-moz-keyframes cssload-animball_two{0%{-moz-transform: rotate(0deg) scale(1)}50%{-moz-transform: rotate(360deg) scale(1.3)}100%{-moz-transform: rotate(720deg) scale(1)}}
    </style>
@endpush

@section('content')
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        <strong><i class="fa-light fa-warning"></i></strong> Do ensure you have completely assigned subjects to their appropriate classes. If not, do so <a
            href="{{ route('create-subject-combo') }}" class="alert-link text-decoration-underline">here</a>.
    </div>



    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    @endif

    <form id="form" action="{{ route('create-result') }}" method="post">
        @csrf

        <div class="mb-4 form-group">

            <label for="student">Select Student</label>
            <select style="width: 100%;height: 100%" name="student" style="height:50px !important" id="student"
                class="
                @error('student')
                    is-invalid
                @enderror
                form-select select2" placeholder="Start typing..." required>
                <option hidden selected value="">Select Student</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
            @error('student')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>




        <div class="mb-4 form-floating">

            <select class="@error('session')
            is-invalid
        @enderror
            form-select" id="session" name="session" required="">
                <option hidden selected value="">Select Session</option>
                @foreach ($sessions as $session)
                    <option value="{{ $session->id }}">{{ $session->name }}</option>
                @endforeach
            </select>
            <label for="session" class="control-label">Academic Session</label>
            @error('session')
            <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>

        <div class="mb-4 form-floating">


            <select name="term" class="
            @error('term')
                    is-invalid
                @enderror
            form-select" id="term" required="required">
                <option hidden selected value="">Select Term</option>
                @foreach ($terms as $term)
                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                @endforeach
            </select>
            <label for="term" class="control-label">Term</label>
            @error('student')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>

        <div class="mb-4 form-floating">


            <select name="class" class="
            @error('class')
                    is-invalid
                @enderror
            form-select clid" id="classid" onChange="getSubject(this.value);"
                required="required">
                <option hidden selected value="">Select Class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach

            </select>
            <label for="classid">Class</label>
            @error('class')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
</div>


        <div class="form-group">
            <div id="loader" align="center" class="cssload-fond">
                <div class="cssload-container-general">
                    <div class="cssload-internal">
                        <div class="cssload-ballcolor cssload-ball_1"> </div>
                    </div>
                    <div class="cssload-internal">
                        <div class="cssload-ballcolor cssload-ball_2"> </div>
                    </div>
                    <div class="cssload-internal">
                        <div class="cssload-ballcolor cssload-ball_3"> </div>
                    </div>
                    <div class="cssload-internal">
                        <div class="cssload-ballcolor cssload-ball_4"> </div>
                    </div>
                </div>
                loading...
            </div>

            <p class="mb-4">Subjects</p>
            <div id="subject">


            </div>




        </div>

        <div class="mb-4 form-floating">

            <textarea name="comment" required style="height: 100px" class="form-control" placeholder=""></textarea>
            <label>Teacher's Comment</label>
        </div>


        <h3 class="h3 my-25">RATING</h3>

        <div class="row g-3">

            @foreach ($rating_names as $rating)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="mb-3 form-floating">
                        <input type="hidden" name="rating_id[]" value="{{ $rating->id }}">

                        <select required name="rating[]" class="form-select">
                            <option hidden selected value="">-- SELECT --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                        <label>{{ $rating->name }}</label>
                    </div>
                </div>
            @endforeach

            <div class="form-group">
                <button type="submit" id="submit" class="btn btn-primary">Create</button>
            </div>

    </form>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Start typing here to search..."
            });
        });
    </script>

    <script>
        $(document).ajaxSend(function() {

        });


        function getSubject(val) {
            var x = document.getElementById("loader");
            var y = document.getElementById("overlay");

            if (typeof(y) != 'undefined' && y != null) {
                // Exists.
                y.style.display = "none";

            }

            x.style.display = "block";



            var token = $('meta[name="csrf_token"]').attr('content');
            var e = document.getElementById("classid");
            var value = e.value;
            //     $("#containloader").fadeIn(300);
            //     setTimeout(function(){

            //     $("#containloader").fadeOut(300);
            //   },400);




            $.ajax({
                type: "POST",

                url: "{{ route('get-subjects') }}",
                data: {
                    'classid': value,
                    '_token': token
                },
                success: function(data) {
                    setTimeout(function() {
                        x.style.display = "none";
                        $("#subject").html(data);
                    }, 1000);
                    // x.style.display = "none";


                }

            });
        }
    </script>


@endpush
