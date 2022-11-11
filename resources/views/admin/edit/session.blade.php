@extends('admin.layouts.layout')
@section('title', 'Edit Session')
@section('header', 'Edit Session')
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('sessions') }}">Sessions</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
@endsection

@section('content')
<form action="{{ route('edit-session', $session->id) }}" method="post">
    @csrf

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        <strong>For example,</strong> 2021/2022.
    </div>

    <div class="form-floating mb-3">
      <input
      value="{{ $session->name }}"
        type="text"
        class="
        @error('name')
        is-invalid
        @enderror
        form-control" name="name" id="name" placeholder="">
      <label for="floatingLabel">Session Name</label>
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror

    </div>

    <button class="btn btn-primary" type="submit">Save</button>

    </form>

@endsection
