@extends('admin.layouts.layout')
@section('title', 'Manage Students')
@section('header', 'Manage Students')
@section('add-url', route('create-student'))
@section('multi-select', route('delete-student', 'multiple'))
@section('itemName', 'student')
@push('style')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"
/>

@endpush

@section('breadcrumbs')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Students</li>
    </ol>
  </nav>
@endsection


@section('content')


    <section id="printable">

        <div class='table-responsive'>
            <table id="tableData" class="caption-top table table-striped table-bordered" border="1" cellspacing="0"
                width="100%">
                <caption id="he">List of Students</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Image</th>
                        <th>Reg No</th>
                        <th>Current Class</th>
                        <th>Gender</th>
                        <th>Reg Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">

                    @foreach($students as $student)
                    <tr>
                        <td><input type="checkbox" class="checkItem me-3" name="delete[]" value="{{ $student->id }}">{{ $loop->iteration }}</td>
                        <td><span id="studentName">{{ $student->name }}</span></td>
                        <td><a href="{{ url('storage/uploads/students/'.$student->image) }}" data-fancybox data-caption="{{ $student->name }}">
                                <img width="40" class="rounded  d-flex mx-auto" src="{{ url('storage/uploads/students/'.$student->image) }}" alt="" />
                            </a></td>
                        <td>{{ $student->regnum }}</td>
                        <td>{{ $student->schoolClass->name }}</td>
                        <td>{{ ucfirst($student->gender) }}</td>
                        <td>{{ Carbon\Carbon::parse($student->created_at)->format('d M, Y H:i a') ?? 'null'}}</td>
                        <td>{{ ucfirst($student->status) }}</td>
                        <td>


                                    <!-- Modal trigger button -->
        <a type="button" data-id="{{ $student->id }}" class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalId">
            Edit
          </a>
                            <a type="button" title="Delete Record" class='text-vermillion' id="delete"
                                data-name='{{ $student->name }}'  data-id='{{ $student->id }}'><i class="fa-thin fa-trash-alt"></i>Delete</a>
                        </td>
                    </tr>
                    @endforeach



                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Image</th>
                        <th>Reg No</th>
                        <th>Current Class</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>


        </div>





       @include('admin.partials.edit-modal-body')



    @endsection


    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        <script>


            $(document).ready( function() {

    // Delete student information
    $(document).on('click', '#delete', function(){
        var id = $(this).data('id');
        var url =  "{{ route('delete-student', ':id') }}";
        url = url.replace(':id', id);
        var el = this;
        var token = $('meta[name="csrf_token"]').attr('content');;
        var name = $(this).data('name');
        swal.fire({
            title: 'Are you sure? <h6>(Page closes in 10 seconds)</h6>',
            html: "<b>NB:</b> <i>Doing this will also delete every single copy of <u><b>" + name + "'s</b></u> result.</i>",
            icon: 'warning',
            timer: 10000,
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Go ahead',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.value){
                $.ajax({
                    url: url,

                    type: 'POST',
                    data: {'_method':'POST', '_token': token},
                    dataType: 'json'
                })
                .done(function(response){
                    swal.fire('Oh Yeah!', "The student <b><u>" + name + "</u></b> has been deleted successfully.", response.status);
                    $(el).closest('tr').css('background','tomato');
                    $(el).closest('tr').fadeOut(900,function(){
                        $(this).remove();
                    });

                })
                .fail(function(){
                    swal.fire('Damn!', 'Beats me, but something went wrong! Try again.', 'error');
                });
            }
        })
    });



    // edit student information
    $('.edit').click(function () {
        let id = $(this).data('id')
        let url = "{{ route('edit-student', ':id') }}"
        url = url.replace(':id', id)
        $.ajax({
            type: "GET",
            url: url,

        })
        .done(function(data) {
            $('.modal-body').html(data)
        })

    })
});


    </script>

    @endpush
