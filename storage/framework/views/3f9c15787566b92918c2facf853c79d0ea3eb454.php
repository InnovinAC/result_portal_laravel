<?php $__env->startSection('content'); ?>
<p>Hi</p>


<style>
    .red-background {
    background-color: red;
    }
    </style>
    <table>
      <colgroup>
        <col>
        <col>
        <col>


    <col class="red-background ">


    <col>


      </colgroup>

    <thead>
    <tr>
        <th style="width: 40%; text-align: center; vertical-align: center;">Nr.<br> crt.</th>
        <th style="font-weight: bold; width: 210%; height: 25; text-align: center; vertical-align: center;">Asistent</th>
        <th style="font-weight: bold; width: 210%; height: 25; text-align: center; vertical-align: center;">Ambulantier</th>
        <th style="text-align: center; vertical-align: center;">Ambulanta</th>
        <th style="text-align: center; vertical-align: center;">Ambulanta</th>




    </tr>
    </thead>
    <tbody>

    <tr>
    <td>0</td>
    <td>Hi</td>
    <td>Hi</td>
    <td>fhf</td>
    <td>fhf</td>

    </tr>

    </tbody>
    </table>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts'); ?>


    <script>
    let username = prompt('Enter your username');
    alert(`Your username is ${username}`)
        </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/admin/test.blade.php ENDPATH**/ ?>