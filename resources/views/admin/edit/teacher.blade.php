@extends('admin.layouts.layout')
@section('title', 'Edit Teacher')
@section('header', 'Edit Teacher')
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('teachers') }}">Teachers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
@endsection

@section('content')

<form action="{{ route('edit-teacher', $id) }}" method="post">
    @csrf
    <div class="form-floating mb-3">
      <input
      value="{{ $teacher->username }}"
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
      value="{{ $teacher->name }}"
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
      value="{{ $teacher->email }}"
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

    <div class="mb-3">
        <label for="" class="form-label">Class</label>
        <select class="@error('class')
        is-invalid
      @enderror form-select" name="class" id="class">
            <option value=''>-- select class --</option>
            @foreach ($school_classes as $school_class)
            <option value="{{ $school_class->id }}"
                @selected(old('class') == $teacher->schoolClass->id)
                 {{ $school_class->id == $teacher->schoolClass->id ? "selected":"" }}>{{ $school_class->name }}</option>
            @endforeach

        </select>
        @error('class')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>



</form>

@endsection
