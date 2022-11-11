@extends('admin.layouts.layout')
@section('title', 'Change Password')
@section('header', 'Change Password')
@section('breadcrumbs')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>

            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
        </ol>
    </nav>
@endsection


@section('content')

<form method="post" action="{{ route('change-password') }}">
    @csrf

    <div class="form-floating mb-4">
      <input
        type="password"
        class="form-control" name="current_password" id="password" placeholder="">
      <label for="floatingLabel">Current Password</label>
    </div>

    <div class="form-floating mb-4">
        <input
          type="password"
          class="
          @error('new_password')
          is-invalid

          @enderror
          form-control" name="new_password" id="password" placeholder="">
        <label for="floatingLabel">New Password</label>
        @error('new_password')
        <div class="invalid-feedback">{{ $message }}</div>

        @enderror
      </div>

      <div class="form-floating mb-4">
        <input
          type="password"
          class="@error('confirm_password')
          is-invalid

          @enderror
          form-control" name="confirm_password" id="password" placeholder="">
        <label for="floatingLabel">Confirm Password</label>
        @error('confirm_password')
        <div class="invalid-feedback">{{ $message }}</div>

        @enderror
      </div>

      <button class="btn btn-primary" type="submit">Save</button>

@endsection
