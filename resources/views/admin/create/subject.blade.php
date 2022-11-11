@extends('admin.layouts.layout')
@section('title', 'Create Subject')
@section('header', 'Create Subject')
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('subjects') }}">Subjects</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection



@section('content')
    <form action="{{ route('create-subject') }}"  method="POST">
        @csrf

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        {{ $error }} <br>
        @endforeach
        @endif

        <div class="form-floating mb-3">
          <input
            value="{{ old('subject_name.*') }}"
            type="text"
            class="@error('subject_name.*')
            is-invalid
            @enderror form-control" name="subject_name[]" id="name" placeholder="">
          <label for="name">Subject Name <span class="text-vermillion">*</span></label>
          @error('subject_name.*')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div id="newSubjects">
        </div>




               <div class="form-group mt-3">
               <button type="submit" class="btn btn-primary">Submit</button>
               <a class="btn btn-brown" id="new"><i class="fa-light fa-plus-circle"></i></a>
               </div>



            </form>







@endsection

@push('scripts')

    <script>

        $('#new').click(function() {
            console.log(5);
            var html = '<div class="form-floating mb-3">' +
                '<input value="" type="text" class="' + 'form-control" name="subject_name[]" ' + 'id="name" placeholder="">' +
            '<label for="name">Subject Name <span class="text-vermillion">*</'+ 'span></label>';
            $('#newSubjects').append(html);
        });

        </script>

@endpush
