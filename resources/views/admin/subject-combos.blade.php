@extends('admin.layouts.layout')
@section('title', 'Manage Subject Combinations')
@section('header', 'Manage Subject Combinations')
@section('add-url', route('create-subject-combo'))
@section('multi-select', route('delete-subject-combo', 'multiple'))
@section('itemName', 'subject combination')

@section('breadcrumbs')

<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Subject Combinations</li>
    </ol>
  </nav>
@endsection

@section('content')

<div class="table-responsive">
    <table id="tableData" class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Class</th>
                <th scope="col">Subject</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subject_combos as $subject_combo)

            <tr class="">
                <td scope="row"><input id="multi_delete[]" type="checkbox" class="checkItem me-3" name="delete[]" value="{{ $subject_combo->id }}">   <label for="multi-delete">{{ $loop->iteration }}</label></td>
                <td>{{ $subject_combo->schoolClass->name }}</td>
                <td>{{ $subject_combo->subject->name }}</td>

                <td>
                    @switch($subject_combo->status)
                        @case('active')
                        <span class="badge bg-success">{{ ucfirst($subject_combo->status) }}</span>
                            @break

                        @default
                        <span class="badge bg-vermillion">{{ ucfirst($subject_combo->status) }}</span>
                        @break
                    @endswitch
                    </td>
                <td><a data-id="{{ $subject_combo->id }}" class='toggle text-decoration-none @switch($subject_combo->status)
                    @case('active')
                    text-vermillion
                        @break

                    @default
                    text-success
                    @break
                @endswitch  me-4' title="@switch($subject_combo->status)
                    @case('active')
                    Deactivate
                        @break

                    @default
                    Activate
                    @break
                @endswitch  Record"> <i class="fa-light fa-power-off"></i>
                    @switch($subject_combo->status)
                    @case('active')
                    Deactivate
                        @break

                    @default
                    Activate
                    @break
                @endswitch
            </a>
                    <a class="text-decoration-none delete text-danger" href="javascript:void" data-subject="{{ $subject_combo->subject->name }}" data-clas="{{ $subject_combo->schoolClass->name }}" data-id='{{ $subject_combo->id }}' title="Delete Record"><i class="fa-light fa-trash-alt"></i> Delete </a></td>
            </tr>

            @endforeach


        </tbody>

        <tfoot>
            <th scope="col">#</th>
            <th scope="col">Class</th>
            <th scope="col">Subject</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tfoot>
    </table>
</div>


@endsection

@push('scripts')

    <script>
        $(document).ready( function() {
$(document).on('click', '.delete', function(){

    var id = $(this).data('id');
    var url = "{{ route('delete-subject-combo', ':id') }}";
    url = url.replace(':id', id);
    var school_class = $(this).data('clas');
    var subject = $(this).data('subject');
    var el = this;
    var token = $('meta[name="csrf_token"]').attr('content');
    var name = $(this).data('name');
    swal.fire({
        title: 'Are you sure you want to delete this subject combination? <h6>(Page closes in 10 seconds)</h6>',
        html: "<b>NB:</b> <i>The subject <b>"+subject+"</b> will no longer be available to be added to new results for <b>"+school_class+"</b></i>",
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
            .done(() => {

                swal.fire('Oh Yeah!', "The subject combination <b><u>" + subject + "</u></b> for <b><u>"+ school_class + " </u></b> has been deleted successfully.");
                $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(900,function(){
                    $(this).remove();
                });

            })
            .fail(() => {
                swal.fire('Damn!', 'Beats me, but something went wrong! Try again.', 'error');
            });
        }
    })
});

});


$('.toggle').click(function() {
    let id = $(this).data('id')
    console.log(id)
    Swal.fire({
        icon: 'warning',
        showCancelButton: true,
        title: 'Are you sure?'

    })
    .then( (result) => {
            if(result.value) {
            let url = "{{ route('toggle-subject-combo', ':id') }}"
            url = url.replace(':id', id)

            window.location.href = url
            }
    })



})
</script>

@endpush

