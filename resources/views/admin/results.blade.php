@extends('admin.layouts.layout')
@section('title', 'Manage Results')
@section('header', 'Manage Results')
@section('add-url', route('create-result'))
@section('multi-select', route('delete-result', 'multiple'))
@section('itemName', 'result')

@section('breadcrumbs')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Results</li>
    </ol>
  </nav>
@endsection


@section('content')

  <div class="table-responsive">
    <table id="tableData" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Student Name</th>
                <th scope="col">Reg Number</th>
                <th scope="col">Class</th>
                <th scope="col">Term</th>
                <th scope="col">Academic Session</th>
                <th scope="col">Student Status</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Updation Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr class="">
                <td scope="row"><input type="checkbox" class="checkItem me-3" name="delete[]" value="{{ $result->id }}">   {{ $loop->iteration }}</td>
                <td>{{ $result->student->name }}</td>
                <td>{{ $result->student->regnum }}</td>
                <td>{{ $result->schoolClass->name }}</td>
                <td>{{ $result->term->name }}</td>
                <td>{{ $result->session->name }}</td>
                <td>{{ ucfirst($result->student->status) }}</td>
                <td>{{ $result->created_at }}</td>
                <td>{{ $result->updated_at }}</td>
                <td><a class="me-3" href="{{ route('edit-result', $result->id) }}" title="Edit Record"><i
                    class="fa-light fa-edit"></i>Edit</a>
            <a type="button" title="Delete Record" class='text-vermillion' id="delete"
                data-name='{{ $result->student->name }}' data-id='{{ $result->id }}'><i class="fa-thin fa-trash-alt"></i>Delete</a>
            </td>
            </tr>

            @endforeach

        </tbody>

        <tfoot>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Student Name</th>
                <th scope="col">Reg Number</th>
                <th scope="col">Class</th>
                <th scope="col">Term</th>
                <th scope="col">Academic Session</th>
                <th scope="col">Student Status</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Updation Date</th>
                <th scope="col">Action</th>
            </tr>
        </tfoot>
    </table>
  </div>

  <div class="circle"></div>


@endsection

@push('scripts')

<script>
    $(document).ready( function() {
$(document).on('click', '#delete', function(){
var id = $(this).data('id');
var url =  "{{ route('delete-result', ':id') }}";
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

});
</script>

@endpush
