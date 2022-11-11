@extends('admin.layouts.layout')
@section('title', 'Create Student')
@section('header', 'Create Student')
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('students') }}">Students</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@section('content')
    <form action="{{ route('create-student') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div id="wrapper mb-4">
        <div class="mb-3">

            <label for="image" class="form-label">Student Image</label>
            <input onchange="preview_image(event)" type="file" class="@error('image')
            is-invalid

            @enderror form-control"  name="image" id="image" placeholder="" aria-describedby="fileHelpId">

            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>

            @enderror
          </div>

          <img class="mb-4 border border-primary p-2 border-2 d-flex mx-auto" id="output_image"/>

        </div>




        <div class="form-floating mb-3">
          <input
            value="{{ old('name') }}"
            type="text"
            class="@error('name')
            is-invalid
            @enderror form-control" name="name" id="name" placeholder="">
          <label for="name">Full Name <span class="text-vermillion">*</span></label>
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>



        <div class="form-floating mb-3">
            <input
              value="{{ old('regnum') }}"
              type="text"
              class="@error('regnum')
              is-invalid
              @enderror form-control" name="regnum" id="regnum" placeholder="">
            <label for="regnum">Registration Number</label>
            @error('regnum')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror

          </div>


          <div class="mb-4 form-floating">

            <select name="class" class="@error('class')
            is-invalid
          @enderror form-select" id="class" required="required">
           <option value="" hidden selected>Select Class</option>
                @foreach ($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
               <label for="class">Class</label>
               @error('class')
               <div class="invalid-feedback">{{ $message }}</div>
             @enderror                                        </div>


             <div class="form-floating mb-3">
                <input
                  value="{{ old('dob') }}"
                  type="date"
                  class="@error('dob')
                  is-invalid
                  @enderror form-control" name="dob" id="dob" placeholder="">
                <label for="dob">Date Of Birth</label>
                @error('dob')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>







             <h6>Gender <span class="text-vermillion">*</span></h6>
             <div class="form-check @error('gender')
            has-validation
             @enderror form-check-inline">

                <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
                <label class="form-check-label" for="">Male</label>
               </div>
               <div class="@error('gender')
               is-invalid
                @enderror form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="female">
                <label class="form-check-label" for="">Female</label>
               </div>
               <div class="@error('gender')
               is-invalid
                @enderror form-check form-check-inline">
                <input required class="form-check-input" type="radio" name="gender" id="gender" value="other">
                <label class="form-check-label" for="">Other</label>


               </div>
               @error('gender')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror



               <div class="form-group mt-3">
               <button type="submit" class="btn btn-primary">Submit</button>
               </div>

            </form>





@endsection

@push('style')
<style>
    #wrapper
{
 text-align:center;
 margin:0 auto;
 padding:0px;
 width:995px;
}
#output_image
{
 max-width:300px;
}
</style>
@endpush

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
