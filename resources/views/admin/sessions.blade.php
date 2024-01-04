@extends('admin.layouts.layout')
@section('title', 'Manage Sessions')
@section('header', 'Manage Sessions')
@section('add-url', route('create-session'))
@section('itemName', 'session')

@section('breadcrumbs')
    <nav
        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sessions</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table" id="tableData">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Session Name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sessions as $session)
                <tr class="">
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $session->name }}</td>
                    <td>
                        <a type="button" data-id="{{ $session->id }}" class="edit me-3" data-bs-toggle="modal" data-bs-target="#modalId"
                           title="Edit Record"><i class="fa-light fa-edit"></i>Edit</a>
                        <a type="button" title="Delete Record" class='text-vermillion' id="delete"
                           data-name='{{ $session->name }}' data-id='{{ $session->id }}'><i
                                class="fa-thin fa-trash-alt"></i>Delete</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Session Name</th>
                <th scope="col">Action</th>
            </tr>
            </tfoot>
        </table>
        @include('admin.partials.edit-modal-body')
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            $(document).on('click', '#delete', function () {
                var id = $(this).data('id');
                var url = "{{ route('delete-session', ':id') }}";
                url = url.replace(':id', id);
                var el = this;
                var token = $('meta[name="csrf_token"]').attr('content');
                ;
                var name = $(this).data('name');
                swal.fire({
                    title: 'Are you sure? <h6>(Page closes in 10 seconds)</h6>',
                    html: "<b>NB:</b> <i>Doing this will also delete every result under the session <i><u><b>" + name + "</b></u></i>",
                    icon: 'warning',
                    timer: 10000,
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Go ahead',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {'_method': 'POST', '_token': token},
                            dataType: 'json'
                        })
                            .done(function (response) {
                                swal.fire('Oh Yeah!', "The subject <b><u>" + name + "</u></b> has been deleted successfully.", response.status);
                                $(el).closest('tr').css('background', 'tomato');
                                $(el).closest('tr').fadeOut(900, function () {
                                    $(this).remove();
                                });

                            })
                            .fail(function () {
                                swal.fire('Damn!', 'Beats me, but something went wrong! Try again.', 'error');
                            });
                    }
                })
            });

            $('.edit').click(function () {
                let id = $(this).data('id')
                let url = "{{ route('edit-session', ':id') }}"
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
