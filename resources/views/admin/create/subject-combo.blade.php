@extends('admin.layouts.layout')
@section('title', 'Create Subject Combination')
@section('header', 'Create Subject Combination')
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('subject-combos') }}">Subject Combinations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')
    <div class="alert mb-4 alert-primary alert-dismissible fade show" role="alert">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       You can add multiple subjects to a class at once.
    </div>




    <script>
      var alertList = document.querySelectorAll('.alert');
      alertList.forEach(function (alert) {
        new bootstrap.Alert(alert)
      })
    </script>

    <form action="{{ route('create-subject-combo') }}" method="post">
    @csrf

    <div class="mb-4 form-floating">

        <select name="class" class="@error('class')
        is-invalid
        @enderror
        form-select" id="class" required="required">
            <option hidden selected value=""><i>Select Class</i></option>

            @foreach ($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>
        <label for="class">Class:</label>
        @error('class')
        <div class="invalid-feedback">{{ $message }}</div>

        @enderror
    </div>

    <div class="mb-4 form-group">

        <label for="default" class="control-label">Subject(s):</label>
        <select style="width: 100%" multiple="multiple" name="subjects[]" class="form-control select2" id="default" required="required">
            <option hidden value="">Select Subject(s)</option>

            @foreach ($subjects as $subject)
            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach

        </select>
        @error('subjects')
        <div class="invalid-feedback">{{ $message }}</div>

        @enderror
    </div>



    <div class="form-group">
        <button type="submit" class="btn btn-primary">Add Combination(s)</button>
    </div>
</form>


@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Type here to search..."
    });
});


</script>
@endpush
