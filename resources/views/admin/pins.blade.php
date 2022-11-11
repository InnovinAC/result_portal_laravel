@extends('admin.layouts.layout')
@section('title', 'Manage Pins')
@section('header', 'Manage Pins')
@section('add-url', route('create-pin'))
@section('multi-select', route('delete-pin', 'multiple'))
@section('itemName', 'pin')

@section('breadcrumbs')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pins</li>
    </ol>
  </nav>
@endsection

@section('content')
<div class="table-responsive">
    <table id="tableData" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pin</th>
                <th scope="col">Trials Left</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pins as $pin)
            <tr class="">
                <td scope="row"><input type="checkbox" class="checkItem me-3" name="delete[]" value="{{ $pin->id }}"> {{ $loop->iteration }}</td>
                <td>{{ $pin->pin }}</td>
                <td>{{ $pin->trials }}</td>
                <td><a type="button" class="text-vermillion" id="delete" data-id="{{ $pin->id }}" data-name="{{ $pin->pin }}"><i class="fa-light fa-trash-alt"></i> Delete</a></td>
            </tr>
            @endforeach


        </tbody>
        <tfoot>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pin</th>
                <th scope="col">Trials Left</th>
                <th scope="col">Action</th>
            </tr>
        </tfoot>
    </table>
</div>


@endsection


@push('scripts')

    <script>
        $(document).ready( function() {
$(document).on('click', '#delete', function(){
    var id = $(this).data('id');
    var url = "{{ route('delete-pin', ':id') }}";
    url = url.replace(':id', id);
    var el = this;
    var token = $('meta[name="csrf_token"]').attr('content');;
    var name = $(this).data('name');
    swal.fire({
        title: 'Are you sure? <h6>(Page closes in 10 seconds)</h6>',
        html: "<b>NB:</b> <i>Doing this nake the pin <i><u><b>" + name + "</b></u></i> unavailable to be used any longer",
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
                swal.fire('Oh Yeah!', "The pin <b><u>" + name + "</u></b> has been deleted successfully.", response.status);
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
