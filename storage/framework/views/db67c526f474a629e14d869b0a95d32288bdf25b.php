<?php $__env->startSection('title', 'Manage Subject Combinations'); ?>
<?php $__env->startSection('header', 'Manage Subject Combinations'); ?>
<?php $__env->startSection('add-url', route('create-subject-combo')); ?>
<?php $__env->startSection('multi-select', route('delete-subject-combo', 'multiple')); ?>
<?php $__env->startSection('itemName', 'subject combination'); ?>

<?php $__env->startSection('breadcrumbs'); ?>

<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Subject Combinations</li>
    </ol>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
            <?php $__currentLoopData = $subject_combos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject_combo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr class="">
                <td scope="row"><input id="multi_delete[]" type="checkbox" class="checkItem me-3" name="delete[]" value="<?php echo e($subject_combo->id); ?>">   <label for="multi-delete"><?php echo e($loop->iteration); ?></label></td>
                <td><?php echo e($subject_combo->schoolClass->name); ?></td>
                <td><?php echo e($subject_combo->subject->name); ?></td>

                <td>
                    <?php switch($subject_combo->status):
                        case ('active'): ?>
                        <span class="badge bg-success"><?php echo e(ucfirst($subject_combo->status)); ?></span>
                            <?php break; ?>

                        <?php default: ?>
                        <span class="badge bg-vermillion"><?php echo e(ucfirst($subject_combo->status)); ?></span>
                        <?php break; ?>
                    <?php endswitch; ?>
                    </td>
                <td><a data-id="<?php echo e($subject_combo->id); ?>" class='toggle text-decoration-none <?php switch($subject_combo->status):
                    case ('active'): ?>
                    text-vermillion
                        <?php break; ?>

                    <?php default: ?>
                    text-success
                    <?php break; ?>
                <?php endswitch; ?>  me-4' title="<?php switch($subject_combo->status):
                    case ('active'): ?>
                    Deactivate
                        <?php break; ?>

                    <?php default: ?>
                    Activate
                    <?php break; ?>
                <?php endswitch; ?>  Record"> <i class="fa-light fa-power-off"></i>
                    <?php switch($subject_combo->status):
                    case ('active'): ?>
                    Deactivate
                        <?php break; ?>

                    <?php default: ?>
                    Activate
                    <?php break; ?>
                <?php endswitch; ?>
            </a>
                    <a class="text-decoration-none delete text-danger" href="javascript:void" data-subject="<?php echo e($subject_combo->subject->name); ?>" data-clas="<?php echo e($subject_combo->schoolClass->name); ?>" data-id='<?php echo e($subject_combo->id); ?>' title="Delete Record"><i class="fa-light fa-trash-alt"></i> Delete </a></td>
            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


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


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>
        $(document).ready( function() {
$(document).on('click', '.delete', function(){

    var id = $(this).data('id');
    var url = "<?php echo e(route('delete-subject-combo', ':id')); ?>";
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
            let url = "<?php echo e(route('toggle-subject-combo', ':id')); ?>"
            url = url.replace(':id', id)

            window.location.href = url
            }
    })



})
</script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/admin/subject-combos.blade.php ENDPATH**/ ?>