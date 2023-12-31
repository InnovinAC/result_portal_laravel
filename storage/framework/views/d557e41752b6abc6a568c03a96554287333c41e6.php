<?php $__env->startSection('title', 'Manage Teachers'); ?>
<?php $__env->startSection('header', 'Manage Teachers'); ?>
<?php $__env->startSection('multi-select', route('delete-teacher', 'multiple')); ?>
<?php $__env->startSection('add-url', route('create-teacher')); ?>
<?php $__env->startSection('itemName', 'teacher'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Teachers</li>
    </ol>
  </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>




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
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkItem me-3" name="delete[]" value="<?php echo e($user->id); ?>">   <?php echo e($loop->iteration); ?>

                                    </td>
                                    <td><?php echo e($user->username); ?>

                                    </td>
                                    <td>
                                        <?php echo e($user->email); ?>

                                    </td>
                                    <td>
                                        <?php echo e($user->schoolClass->name); ?>

                                    </td>
                                    <td>
                                        <?php switch($user->role):
                                            case (1): ?>
                                            Admin

                                                <?php break; ?>

                                            <?php default: ?>
                                            Teacher

                                        <?php endswitch; ?>

                                    </td>

                                    <td>
                                        <a class="me-3" href="<?php echo e(route('edit-teacher', ['id' => $user->id])); ?>" title="Edit User"><i class="fa-light fa-edit"></i>Edit</a>
<a type="button" id="delete" class="text-vermillion"  data-name="<?php echo e($user->name); ?>" data-id="<?php echo e($user->id); ?>" title="Delete User"><i class="fa-light fa-trash-alt"></i> Delete </a>

                                    </td>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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



<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).on('click', '#delete', function(){
    var id = $(this).data('id');
    var url = "<?php echo e(route('delete-teacher', ':id')); ?>";
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

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/innovin/Documents/projects/result_portal_laravel/resources/views/admin/teachers.blade.php ENDPATH**/ ?>