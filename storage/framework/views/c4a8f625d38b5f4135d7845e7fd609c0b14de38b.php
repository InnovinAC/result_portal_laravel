<?php $__env->startSection('title', 'Manage Subjects'); ?>
<?php $__env->startSection('header', 'Manage Subjects'); ?>
<?php $__env->startSection('add-url', route('create-subject')); ?>
<?php $__env->startSection('multi-select', route('delete-subject', 'multiple')); ?>
<?php $__env->startSection('itemName', 'subject'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subjects</li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="table-responsive">
        <table id="tableData" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="">
                        <td scope="row"><input type="checkbox" class="checkItem me-3" name="delete[]"
                                value="<?php echo e($subject->id); ?>"> <?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($subject->name); ?></td>
                        <td><!-- Modal trigger button -->
                            <a type="button" data-id="<?php echo e($subject->id); ?>" class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalId">
                                Edit
                              </a>
                            <a type="button" title="Delete Record" class='text-vermillion delete' id="delete"
                                data-name='<?php echo e($subject->name); ?>' data-id='<?php echo e($subject->id); ?>'><i
                                    class="fa-thin fa-trash-alt"></i>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </tbody>
        </table>
    </div>

    </table>

    <?php echo $__env->make('admin.partials.edit-modal-body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script>

        $(document).ready(function() {

            // Delete subject information
            $(document).on('click', '#delete', function() {
                var id = $(this).data('id');
                var url = "<?php echo e(route('delete-subject', ['id' => ':id'])); ?>";
                url = url.replace(':id', id);
                var el = this;
                var token = $('meta[name="csrf_token"]').attr('content');;
                var name = $(this).data('name');
                Swal.fire({
                    title: 'Are you sure? <h6>(Page closes in 10 seconds)</h6>',
                    html: "<b>NB:</b> <i>Doing this will also delete the subject <b>" + name +
                        "</b> from every student's result as well as all existing subject combinations of the subject <b>" +
                        name + "</b>.",
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
                                data: {
                                    '_method': 'POST',
                                    '_token': token
                                },
                                dataType: 'json'
                            })
                            .done(function() {

                                swal.fire('Oh Yeah!', `The subject <b><u>${name}</u></b> has been deleted successfully.`, 'success');
                                $(el).closest('tr').css('background', 'tomato');
                                $(el).closest('tr').fadeOut(900, function() {
                                    $(this).remove();
                                });

                            })
                            .fail(function() {
                                console.log(0)
                                swal.fire('Damn!',
                                    'Beats me, but something went wrong! Try again.',
                                    'error');
                            });
                    }
                })

            });

        // Edit subject information
    $('.edit').click(function () {
        let id = $(this).data('id')
        let url = "<?php echo e(route('edit-subject', ':id')); ?>"
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/admin/subjects.blade.php ENDPATH**/ ?>