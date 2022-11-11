@extends('admin.layouts.layout')
@section('title', 'Create Teacher')
@section('header', 'Create Teacher')
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('teachers') }}">Teachers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@section('content')
    <form action={{ route('create-teacher') }} method="POST">
        @csrf


        <div class="row mb-3 gx-4">

            <div class="col-sm col-md-6">
                <div class="form-floating mb-4">

                    <input type="text" class="@error('username') is-invalid
@enderror form-control" id="example"
                        value="{{ old('username') }}" name="username" autocomplete="off" placeholder="Enter Username.">
                    <label for="username"><span class='fa-light fa-user'></span> Username:</label>

                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-sm col-md-6">
                <div class="form-floating mb-4">

                    <input type="text" class="@error('name') is-invalid
@enderror form-control" id="name"
                        value="{{ old('name') }}" name="name" autocomplete="off" placeholder="Enter Username.">
                    <label for="name"><span class='fa-light fa-user'></span> Full Name:</label>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-sm col-md-6">
                <div class="form-floating mb-4">

                    <input value="{{ old('email') }}"type="email" class="@error('email') is-invalid
@enderror form-control" name="email"
                        id="email" placeholder="Enter email address">
                    <label for="email"><span class='fa-light fa-envelope'></span> Email:</label>

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-sm col-md-6">
                <div class="form-floating">

                    <input type="password" class="@error('password') is-invalid
@enderror border-right-0 form-control"
                        name="password" id="password" placeholder="Enter password.">


                    <label for="password"><span class='fa-light fa-key'></span> Password:</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <a href="#password" class="" id="toggle_pwd">Show</a>
            </div>

            <div class="col-sm col-md-6">
                <div class="has-validation form-floating">


                    <input type="password" class="@error('confirm') is-invalid
    @enderror border-right-0 form-control"
                        name="confirm" id="confirm" placeholder="Enter password.">


                    <label for="confirm"><span class='fa-light fa-key'></span> Confirm Password:</label>
                    @error('confirm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <a href="#confirm" class="" id="toggle_cfm">Show</a>
            </div>

            <div class="col-sm col-md-6">
                <div class="form-floating">

                    <select name="class"
                        class="@error('class')
                            is-invalid
                        @enderror form-select"
                        id="class">
                        <option value="" selected>Select Class</option>

                        @foreach ($school_classes as $school_class)
                            <option @if($school_class->id==old('class')) selected @endif value="{{ $school_class->id }}">{{ $school_class->name }}</option>
                        @endforeach


                    </select>
                    <label for="class">Class</label>
                    @error('class')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mb-2" name="submit">Create User</button>
    </form>


    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#toggle_pwd").click(function() {
                var passInput = $("#password");
                if (passInput.attr('type') === 'password') {
                    document.getElementById("toggle_pwd").innerHTML = "Hide";
                    passInput.attr('type', 'text');
                } else {
                    document.getElementById("toggle_pwd").innerHTML = "Show";
                    passInput.attr('type', 'password');
                }

            });
        });


        $(function() {
            $("#toggle_cfm").click(function() {
                var passInput = $("#confirm");
                if (passInput.attr('type') === 'password') {
                    document.getElementById("toggle_cfm").innerHTML = "Hide";
                    passInput.attr('type', 'text');
                } else {
                    document.getElementById("toggle_cfm").innerHTML = "Show";
                    passInput.attr('type', 'password');
                }

            });
        });
    </script>
@endpush
