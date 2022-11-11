@extends('admin.layouts.layout')
@section('title', 'Manage Teachers')
@section('header', 'Manage Teachers')
@section('multi-select', route('delete-teacher', 'multiple'))
@section('add-url', route('create-teacher'))
@section('itemName', 'teacher')
@section('breadcrumbs')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Teachers</li>
    </ol>
  </nav>
@endsection
@section('content')




                <div class="mb-2 d-md-none d-print-none alert alert-primary">The table below can be scrolled from left to
                    right on smaller screens.</div>

                <section id="printable">
                    <div class="table-responsive">
                        <table id="tableData" class="table-responsive-md table table-striped table-bordered" border="1"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email </th>
                                    <th>Class</th>
                                    <th>Role</th>


                                    <th> Action </th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkItem me-3" name="delete[]" value="{{ $user->id }}">   {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $user->username }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->schoolClass->name }}
                                    </td>
                                    <td>
                                        @switch($user->role)
                                            @case(1)
                                            Admin

                                                @break

                                            @default
                                            Teacher

                                        @endswitch

                                    </td>

                                    <td>
                                        <a class="me-3" href="{{ route('edit-teacher', ['id' => $user->id]) }}" title="Edit User"><i class="fa-light fa-edit"></i>Edit</a>
<a type="button" id="delete" class="text-vermillion"  data-name="{{ $user->name }}" data-id="{{ $user->id }}" title="Delete User"><i class="fa-light fa-trash-alt"></i> Delete </a>

                                    </td>

                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Class</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>


                    </div>
                </section>



@endsection

@push('scripts')
<script>
$(document).on('click', '#delete', function(){
    var id = $(this).data('id');
    var url = "{{ route('delete-teacher', ':id') }}";
    url = url.replace(':id', id);
    var el = this;
    var name = $(this).data('name');
    var token=$('meta[name="csrf_token"]').attr('content');
    swal.fire({
        title: 'Are you sure? <h6>(Page closes in 10 seconds)</h6>',
        html: "<b>NB:</b> <i>Doing this will delete the teacher <u><b>" + name + "</b></u> from the database.</i>",
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
                data: {'_method' : 'POST', '_token' :token},
                dataType: 'json'
            })
            .done(function(response){
                swal.fire('Oh Yeah!', "The teacher <b><u>" + name + "</u></b> has been deleted successfully.", response.status);
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
</script>

@endpush
