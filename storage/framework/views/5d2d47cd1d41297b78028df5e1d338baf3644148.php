<?php $__env->startSection('title', 'Manage Pins'); ?>
<?php $__env->startSection('header', 'Manage Pins'); ?>
<?php $__env->startSection('add-url', route('create-pin')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pins</li>
    </ol>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
            <?php $__currentLoopData = $pins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="">
                <td scope="row"><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($pin->pin); ?></td>
                <td><?php echo e($pin->trials); ?></td>
                <td><a type="button" class="text-vermillion" id="delete" data-id="<?php echo e($pin->id); ?>" data-name="<?php echo e($pin->pin); ?>"><i class="fa-light fa-trash-alt"></i> Delete</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


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


<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>

    <script>
        $(document).ready( function() {
$(document).on('click', '#delete', function(){
    var id = $(this).data('id');
    var url = "<?php echo e(route('delete-pin', ':id')); ?>";
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

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\result_laravel\resources\views\admin\pins.blade.php ENDPATH**/ ?>