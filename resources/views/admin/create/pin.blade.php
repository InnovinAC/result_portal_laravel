@extends('admin.layouts.layout')
@section('title', 'Create Pins')
@section('header', 'Create Pins')
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('pins') }}">Pins</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@section('content')
    <form method="post" action="{{ route('create-pin') }}">
        @csrf
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    <strong>NB!</strong> You are only allowed to <br>
    <ul>
    <li>create a maximum of 500 pins at the same time</li>
    <li>have a maximum of 10 character pins</li>
    <li>have a minimum of 3 pin trials</li>
    <hr>
    The process might take as much as 5 seconds.
</div>

        <div class="form-floating mb-3">
          <input max="500"
            type="number"
            class="@error('count')
            is-invalid
            @enderror
            form-control" name="count" id="count" required placeholder="">
          <label for="floatingLabel">Number of Pins To Generate</label>
          @error('count')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>


        <div class="form-floating mb-3">
            <input
              type="number"
              class="@error('characters')
              is-invalid
              @enderror
              form-control" required name="characters" id="characters" placeholder="">
            <label for="floatingLabel">Number of Pins Characters</label>
            @error('characters')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          </div>


          <div class="form-floating mb-3">
            <input
            min="3"
              type="number"
              class="@error('trials')
              is-invalid
            @enderror
              form-control" required name="trials" id="trials" placeholder="">
            <label for="floatingLabel">Number of Pins Trials</label>
            @error('trials')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>


          <button class="btn btn-primary" type="submit">Add</button>




    </form>
@endsection

@push('scripts')
<script>
    $('#count').on('keyup keydown change', function(e){
    console.log($(this).val() > 500)
        if ($(this).val() > 500
            && e.keyCode !== 46
            && e.keyCode !== 8
           ) {
           e.preventDefault();
           $(this).val(500);
        }
    });


    $('#characters').on('keyup keydown change', function(e){
    console.log($(this).val() > 10)
        if ($(this).val() > 10
            && e.keyCode !== 46
            && e.keyCode !== 8
           ) {
           e.preventDefault();
           $(this).val(10);
        }
    });


    // $('#trials').on('keyup keydown change', function(e){
    // console.log($(this).val() < 3)
    //     if ($(this).val() < 3
    //         && e.keyCode !== 46
    //         && e.keyCode !== 8
    //        ) {
    //        e.preventDefault();
    //        $(this).val(3);
    //     }
    // });
    </script>

@endpush
