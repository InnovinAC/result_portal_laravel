<?php $__env->startSection('title', 'Manage Students'); ?>
<?php $__env->startSection('header', 'Manage Students'); ?>
<?php $__env->startSection('add-url', route('create-student')); ?>
<?php $__env->startSection('multi-select', route('delete-student', 'multiple')); ?>
<?php $__env->startSection('itemName', 'student'); ?>
<?php $__env->startPush('style'); ?>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"
/>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Students</li>
    </ol>
  </nav>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


    <section id="printable">

        <div class='table-responsive'>
            <table id="tableData" class="caption-top table table-striped table-bordered" border="1" cellspacing="0"
                width="100%">
                <caption id="he">List of Students</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Image</th>
                        <th>Reg No</th>
                        <th>Current Class</th>
                        <th>Gender</th>
                        <th>Reg Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">

                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><input type="checkbox" class="checkItem me-3" name="delete[]" value="<?php echo e($student->id); ?>"><?php echo e($loop->iteration); ?></td>
                        <td><span id="studentName"><?php echo e($student->name); ?></span></td>
                        <td><a href="<?php echo e(url('storage/uploads/students/'.$student->image)); ?>" data-fancybox data-caption="<?php echo e($student->name); ?>">
                                <img width="40" class="rounded  d-flex mx-auto" src="<?php echo e(url('storage/uploads/students/'.$student->image)); ?>" alt="" />
                            </a></td>
                        <td><?php echo e($student->regnum); ?></td>
                        <td><?php echo e($student->schoolClass->name); ?></td>
                        <td><?php echo e(ucfirst($student->gender)); ?></td>
                        <td><?php echo e(Carbon\Carbon::parse($student->created_at)->format('d M, Y H:i a') ?? 'null'); ?></td>
                        <td><?php echo e(ucfirst($student->status)); ?></td>
                        <td>


                                    <!-- Modal trigger button -->
        <a type="button" data-id="<?php echo e($student->id); ?>" class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalId">
            Edit
          </a>
                            <a type="button" title="Delete Record" class='text-vermillion' id="delete"
                                data-name='<?php echo e($student->name); ?>'  data-id='<?php echo e($student->id); ?>'><i class="fa-thin fa-trash-alt"></i>Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Image</th>
                        <th>Reg No</th>
                        <th>Current Class</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>


        </div>





       <?php echo $__env->make('admin.partials.edit-modal-body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    <?php $__env->stopSection(); ?>


    <?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        <script>


            $(document).ready( function() {

    // Delete student information
    $(document).on('click', '#delete', function(){
        var id = $(this).data('id');
        var url =  "<?php echo e(route('delete-student', ':id')); ?>";
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



    // edit student information
    $('.edit').click(function () {
        let id = $(this).data('id')
        let url = "<?php echo e(route('edit-student', ':id')); ?>"
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

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/admin/students.blade.php ENDPATH**/ ?>