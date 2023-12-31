<?php $__env->startSection('title', 'Editing ' . $result->student->name . '\'s Result'); ?>
<?php $__env->startSection('header'); ?>
    Editing <i><b> <?php echo e($result->student->name); ?>'s</b></i> Result
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('results')); ?>">Results</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('edit-result', $result->id)); ?>">
        <?php echo csrf_field(); ?>

        <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($error); ?> <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>

        <input type="hidden" name="result_id" value="<?php echo e($result->id); ?>">

        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>NB</strong> You are not allowed to edit the term/session on a result. <br>
            In order to remove a subject from a result, just leave the scores empty.
        </div>

        <div class="form-floating mb-3">
            <input disabled class="form-control" value="<?php echo e(ucfirst($result->student->gender)); ?>">
            <label>Gender</label>
        </div>

        <div class="form-floating mb-3">
            <input disabled class="form-control" value="<?php echo e($result->schoolClass->name); ?>">
            <label>Class</label>
        </div>



        <div class="form-floating mb-3">
            <input disabled name="session" class="form-control" value="<?php echo e($result->session->name); ?>">
            <label>Session</label>
        </div>


        <div class="form-floating mb-3">
            <input disabled name="session" class="form-control" value="<?php echo e($result->term->name); ?>">
            <label>Term</label>
        </div>


        <div class="h4 mt-4  mb-4 text-muted">Subjects</div>

        <div id="extra_subjects" class="row mb-4 g-3">
            <?php
                $arranged_subjects_count = count($arranged_subjects);
            ?>
            <?php for($i = 0; $i < $arranged_subjects_count; ++$i): ?>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 subject<?php echo e($arranged_subjects[$i]->id); ?>">
                    <div class="border mb-4 rounded border-dark shadow-sm py-4 px-3">
                        <a type="button" data-id="<?php echo e($arranged_subjects[$i]->id); ?>" class="text-decoration-none text-vermillion subject-remover float-end"><span class="text-10"><i class="fa-light fa-times-circle"></i> Remove</span></a>

                        <div class="form-group">
                            <div class="mb-2"><b class="text-underline"><?php echo e($arranged_subjects[$i]->name); ?></b></div>
                            <input type="hidden" name="subject_id[]" value="<?php echo e($arranged_subjects[$i]->id); ?>">

                            <div class="form-floating mb-3">

                                <input type="number" max="40" name="cas[]" value="<?php echo e($scores[$i][0]); ?>"
    oninput="pairAndValue()"
                                    class="cas form-control" placeholder="Enter marks out of 40" autocomplete="off">
                                <label>CA Score(Out of 40)</label>
                            </div>

                            <div class="form-floating mb-3">

                                <input
                                oninput="pairAndValue()"
                                type="number" max="60" name="exams[]" value="<?php echo e($scores[$i][1]); ?>"
                                    class="exams form-control" placeholder="Enter marks out of 60" autocomplete="off">
                                <label>Exam Score(Out of 60)</label>
                            </div>
                        </div>
                    </div>
                </div>



            <?php endfor; ?>
                </div>

                <div class="mb-3">
                    <h6> Add New Subjects </h6>

                <?php if($not_subjects->count()): ?>

            <?php $__currentLoopData = $not_subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $not_subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span type="button" name="<?php echo e($not_subject->subject->name); ?>" onclick="addSubject(this)" id="<?php echo e($not_subject->subject_id); ?>" class="badge bg-primary"><?php echo e($not_subject->subject->name); ?></span>


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><i class="fa-light fa-warning"></i> No extra Subjects to add.
                </div>

            </div>

                <?php endif; ?>


            <div class="form-floating mb-5">

                <textarea style="height: 100px" placeholder="Teacher's Comment" id="comment" name="comment" rows="7"
                    class="form-control"><?php echo e($result->comment); ?></textarea>
                <label for="comment">Teacher's Comment</label>
            </div>





        <h3 class="h3 my-25">RATING</h3>

        <div class="row g-3">
            <?php
                $ratings_count = count($ratings);
            ?>
            <?php for($i=0; $i < $ratings_count; $i++): ?>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
        <div class="mb-3 form-floating">
        <input type="hidden" name="rating_id[]" value="<?php echo e($rating_ids[$i]); ?>">

        <select required name="rating[]" class="form-select">
        <option hidden value="">-- SELECT --</option>
        <option <?php echo e($ratings[$rating_ids[$i]] == "A" ? "selected": ""); ?> value="A">A</option>
        <option <?php echo e($ratings[$rating_ids[$i]] == "B" ? "selected": ""); ?> value="B">B</option>
        <option <?php echo e($ratings[$rating_ids[$i]] == "C" ? "selected": ""); ?> value="C">C</option>
        <option <?php echo e($ratings[$rating_ids[$i]] == "D" ? "selected": ""); ?> value="D">D</option>
        <option <?php echo e($ratings[$rating_ids[$i]] == "E" ? "selected": ""); ?> value="E">E</option>

        </select>
        <label><?php echo e($rating_names[$i]); ?></label>
        </div>
      </div>
      <?php endfor; ?>

                  </div>
                  <span id="tooltip" class="d-inline-block">
        <button class="btn mt-3 btn-primary" type="submit" id="submit">Update</button>



    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script>
function pairAndValue() {
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




  if (nosubmit().includes("d")) {

    $('#submit').attr({
        'disabled' : true
    });

    $('#tooltip').attr({
        'data-placement' : 'top',
        'data-toggle': 'tooltip',
        'title' : 'Disabled because you have an incomplete CA and Exam score pair.'
    });
  } else {
    $("#submit").attr('disabled', false);




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
}


</script>

<script>
$('a.subject-remover').click(function() {
    if($('a.subject-remover').length > 1) {

    let id = $(this).data('id')
    $('div.subject'+id).fadeOut(500, function() {
        $(this).remove();
    })
    }
    else {
        // alert('You cannot delete all subjects from a result')

        Swal.fire({
            icon: 'warning',
            title: 'Nope',
            text: 'You cannot delete all subjects from a <small>result</small>. Delete it instead.',

        });
    }
})
    </script>
<script>

    function addSubject(x) {
        id = x.getAttribute('id');
        name = x.getAttribute('name');

        x.addEventListener("click", function() {


        })

    document.getElementById("extra_subjects").innerHTML += "<div id='remove"+id+"' class='col-sm-12 col-md-6 animate__animated animate__bounceIn col-lg-6 col-xl-6'>" +
                    "<div class='border mb-4 rounded border-dark shadow-sm py-4 px-3'>" +

                        "<div class='form-group'>" +
                            "<div class='mb-2'><b class='text-underline'>"+name+"</b></div>" +
                            "<input type='hidden' name='subject_id[]' value='"+id+"'>" +

                            "<div class='form-floating mb-3'>" +

                                "<input oninput='pairAndValue()' type='number' max='40' name='cas[]' value='' class='cas form-control' placeholder='Enter marks out of 40' autocomplete='off'>" +
                                "<label>CA Score(Out of 40)</label>" +
                            "</div>" +

                            "<div class='form-floating mb-3'>" +

                                "<input oninput='pairAndValue()' type='number' max='60' name='exams[]' value='' class='exams form-control' placeholder='Enter marks out of 60' autocomplete='off'>" +
                                "<label>Exam Score(Out of 60)</label>" +
                            "</div></div></div></div>";

                            document.getElementById(id).remove();
                            document.getElementById("remove"+id).classList.remove("animate__animated" ,"animate__bounceIn");
                            nosubmit();

    }
</script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/innovin/Documents/projects/result_portal_laravel/resources/views/admin/edit/result.blade.php ENDPATH**/ ?>