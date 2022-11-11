@extends('admin.layouts.layout')
@section('title', 'Edit Profile')
@section('header', 'Edit Profile')
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>

            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
        </ol>
    </nav>
@endsection

@push('style')
<style>

#output_image
{
 max-width:300px;
}
</style>
@endpush


@section('content')

<form action="{{ route('edit-profile') }}" method="post" enctype="multipart/form-data">
    @csrf
    <a id="" class="btn mb-4  btn-primary" href="{{ route('change-password') }}" role="button">Change Password</a>

<div class="row mt-4 g-5">
    <div id="wrapper" class="mb-4 border-end col-lg-6 col-xl-6">



        <img id="output_image" class="shadow-sm img-fluid img-responsive img-thumbnail"width="300px" src="{{ url('storage/uploads/admin/'.$user->image) }}">

        <div class="mt-3">

            <label for="image" class="form-label">Change Image</label>
            <input onchange="preview_image(event)" type="file" class="@error('image')
            is-invalid
            @enderror
            form-control"  name="image" id="image" placeholder="" aria-describedby="fileHelpId">

            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

                      </div>

    </div>


    <div class="col-lg-6 col-xl-6">

    <div class="form-floating mb-3">
      <input
      value="{{ $user->username }}"
        type="text"
        class="@error('username')
        is-invalid
        @enderror form-control" name="username" id="username" placeholder="">
      <label for="floatingLabel">Username</label>
      @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>


    <div class="form-floating mb-3">
      <input
      value="{{ $user->name }}"
        type="text"
        class="@error('name')
        is-invalid
      @enderror form-control" name="name" id="email" placeholder="">
      <label for="floatingLabel">Full Name</label>
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-floating mb-3">
      <input
      value="{{ $user->email }}"
        type="text"
        class="@error('email')
        is-invalid
      @enderror
         form-control" name="email" id="email" placeholder="">
      <label for="floatingLabel">Email Address</label>
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3 form-floating">

        <input disabled class="form-control" id="class"
            value=" {{ $school_class }}">
            <label for="" class="form-label">Class</label>
    </div>






    <button type="submit" class="btn btn-primary">Save</button>

    </div>
    </div>

</form>

@endsection

@push('scripts')
<script type='text/javascript'>
    function preview_image(event)
    {
     var reader = new FileReader();
     reader.onload = function()
     {
      var output = document.getElementById('output_image');
      output.src = reader.result;
     }
     reader.readAsDataURL(event.target.files[0]);
    }
    </script>
@endpush
