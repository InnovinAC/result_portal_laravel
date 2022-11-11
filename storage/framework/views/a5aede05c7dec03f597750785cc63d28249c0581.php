<?php if(count($subjects) < 1): ?>
<script>$('#submit').prop('disabled', true);</script>
<div id="overlay">
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    <strong>Sorry!</strong> No subjects have been assigned to <u><?php echo e($class_name); ?></u> yet.
</div>
</div>


<?php else: ?>
<script>$('#submit').prop('disabled', false);</script>

<div id="overlay">

<div class="alert alert-warning"><i class="fa-light fa-warning"></i> If a student is not offering a particular subject, kindly leave both the CA and Exam scores empty, otherwise the form would be disabled. </div>

<div class="row animate__faster animate__animated animate__bounceIn">

<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
    <div class="border mb-4 rounded border-dark shadow-sm py-4 px-3">
  <p>
<input type="hidden" name="subjectid[]" value="<?php echo e($subject->subject->id); ?>"><b class="text-underline"><?php echo e($subject->subject->name); ?></b></p><br>


<div class="form-floating mb-4">
    <input type="number" id="cas" min="0" max="" name="cas[]" value="" class="cas form-control" placeholder="Enter marks out of 40" autocomplete="off"><label>CA Score(Enter marks out of 40)</label></div>


<div class="form-floating">
    <input type="number" id="exams" min="0" max="" name="exams[]" value="" class="exams form-control" placeholder="Enter marks out of 60" autocomplete="off"><label>Exam Score(Enter marks out of 60)</label></div></div>
</div>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
<script>
    var cas = document.getElementsByClassName("cas");
var exams = document.getElementsByClassName("exams");
var numOfPairs = cas.length;


for (i = 0; i < numOfPairs; i++) {
$(cas).on('keyup keydown change', function(e){
    console.log($(this).val() > 40)
        if ($(this).val() > 40
            && e.keyCode !== 46
            && e.keyCode !== 8
           ) {
           e.preventDefault();
           $(this).val(40);
        }
    });

    $(exams).on('keyup keydown change', function(e){
    console.log($(this).val() > 60)
        if ($(this).val() > 60
            && e.keyCode !== 46
            && e.keyCode !== 8
           ) {
           e.preventDefault();
           $(this).val(60);
        }
    });
}

window.oninput = function() {

  if (nosubmit().includes("d")) {
    document.getElementById("submit").disabled = true;
  } else {
    document.getElementById("submit").disabled = false;
  }



}

function nosubmit() {
  var check = ""
  for (i = 0; i < numOfPairs; i++) {
    if ((cas[i].value != "" && exams[i].value == "") || (cas[i].value == "" && exams[i].value != "")) {
      check += "d";
    } else {
      check += "e";
    }
  }
  return check
}

</script>

<?php endif; ?>




<?php /**PATH C:\xampp\htdocs\result_laravel\resources\views/admin/partials/get-subjects.blade.php ENDPATH**/ ?>