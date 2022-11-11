{{-- @extends('admin.layouts.layout')
@section('title', 'Edit Subject')
@section('header', 'Edit Subject')

@section('breadcrumbs')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('subjects') }}">Subjects</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
@endsection


@section('content')

<form action="{{ route('edit-subject', $subject->id) }}"  method="POST">
    @csrf

    <div class="form-floating mb-3">
        <input
          value="{{ $subject->name }}"
          type="text"
          class="@error('name')
          is-invalid
          @enderror form-control" name="name" id="name" placeholder="">
        <label for="name">Subject Name <span class="text-vermillion">*</span></label>
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>


      <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Save</button>
        </div>

     </form>



@endsection --}}

<hehehe>
<form id='edit' action="{{ route('edit-subject', $subject->id) }}"  method="POST">
    @csrf

    <div class="form-floating mb-3">
        <input
          value="{{ $subject->name }}"
          type="text"
          class="@error('name')
          is-invalid
          @enderror form-control" name="name" id="name" placeholder="">
        <label for="name">Subject Name <span class="text-vermillion">*</span></label>
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>


     </form>

     <script>
        $('#submit').click(function () {
            let counter = 0
            let text = ['loading.', 'loading..', 'loading...', 'loading.', 'loading..', 'loading...']
            const change = () => {
                $('#submit').text(text[counter])
                counter ++
            }
            setInterval(change, 250);
            setTimeout(() => {
                $('#edit').submit()
            }, 1000)

        })

    </script>



