<?php $__env->startSection('title', 'Manage Sessions'); ?>
<?php $__env->startSection('header', 'Manage Sessions'); ?>
<?php $__env->startSection('add-url', route('create-session')); ?>
<?php $__env->startSection('itemName', 'session'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sessions</li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="">
                        <td scope="row"><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($session->name); ?></td>
                        <td>
                            <a class="me-3" href="<?php echo e(route('edit-session', ['id' => $session->id])); ?>"
                                title="Edit Record"><i class="fa-light fa-edit"></i>Edit</a>
                            <a type="button" title="Delete Record" class='text-vermillion' id="delete"
                                data-name='<?php echo e($session->name); ?>' data-id='<?php echo e($session->id); ?>'><i
                                    class="fa-thin fa-trash-alt"></i>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
            <tfoot>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Session Name</th>
                    <th scope="col">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>
        $(document).ready( function() {
$(document).on('click', '#delete', function(){
    var id = $(this).data('id');
    var url = "<?php echo e(route('delete-session', ':id')); ?>";
    url = url.replace(':id', id);
    var el = this;
    var token = $('meta[name="csrf_token"]').attr('content');;
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
        if (result.value){
            $.ajax({
                url: url,
                type: 'POST',
                data: {'_method':'POST', '_token': token},
                dataType: 'json'
            })
            .done(function(response){
                swal.fire('Oh Yeah!', "The subject <b><u>" + name + "</u></b> has been deleted successfully.", response.status);
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

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/admin/sessions.blade.php ENDPATH**/ ?>