
<style>
    #wrapper {
        text-align: center;
        margin: 0 auto;
        padding: 0px;
        width: 995px;
    }

    #output_image {
        max-width: 100px;
    }
</style>







<form id="edit" action="{{ route('edit-student', $student->id) }}" enctype="multipart/form-data"
method="POST">
                @csrf
                <div id="wrapper mb-4">
                    <div class="mb-3">

                        <label for="image" class="form-label">Change Student Image</label>
                        <input onchange="preview_image(event)" type="file" class="form-control" name="image"
                            id="image" placeholder="" aria-describedby="fileHelpId">


                    </div>
                    <a href="{{ url('storage/uploads/students/' . $student->image) }}" data-fancybox
                        data-caption="{{ $student->name }}">
                        <img style="max-width: 300px" src="{{ url('storage/uploads/students/' . $student->image) }}"
                            class="mb-4 border border-primary p-2 border-2 d-flex mx-auto" id="output_image" />
                    </a>

                </div>




                <div class="form-floating mb-3">
                    <input value="{{ $student->name }}" type="text"
                        class="@error('name')
            is-invalid
            @enderror form-control" name="name"
                        id="name" placeholder="">
                    <label for="name">Full Name <span class="text-vermillion">*</span></label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <div class="form-floating mb-3">
                    <input value="{{ $student->regnum }}" type="text"
                        class="@error('regnum')
              is-invalid
              @enderror form-control"
                        name="regnum" id="regnum" placeholder="">
                    <label for="regnum">Registration Number</label>
                    @error('regnum')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-4 form-floating">

                    <select name="class"
                        class="@error('class')
            is-invalid
          @enderror form-select" id="class"
                        required="required">
                        <option value="" hidden selected>Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}"
                                {{ $class->id == $student->schoolClass->id ? 'selected' : '' }}>{{ $class->name }}
                            </option>
                        @endforeach

                    </select>
                    <label for="class">Class</label>
                    @error('class')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-floating mb-3">
                    <input value="{{ $student->date_of_birth }}" type="date"
                        class="@error('dob')
                  is-invalid
                  @enderror form-control"
                        name="dob" id="dob" placeholder="">
                    <label for="dob">Date Of Birth</label>
                    @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>







                <h6>Gender <span class="text-vermillion">*</span></h6>
                <div
                    class="form-check @error('gender')
            has-validation
             @enderror form-check-inline">

                    <input class="form-check-input" type="radio" name="gender" id="gender"
                        {{ $student->gender == 'male' ? 'checked' : '' }} value="male">
                    <label class="form-check-label" for="">Male</label>
                </div>
                <div
                    class="@error('gender')
               is-invalid
                @enderror form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender"
                        {{ $student->gender == 'female' ? 'checked' : '' }} value="female">
                    <label class="form-check-label" for="">Female</label>
                </div>
                <div
                    class="@error('gender')
               is-invalid
                @enderror form-check form-check-inline">
                    <input {{ $student->gender == 'other' ? 'checked' : '' }} required class="form-check-input"
                        type="radio" name="gender" id="gender" value="other">
                    <label class="form-check-label" for="">Other</label>


                </div>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror



                <h6>Status <span class="text-vermillion">*</span></h6>
                <div
                    class="form-check @error('status')
            has-validation
             @enderror form-check-inline">

                    <input class="form-check-input" type="radio" name="status" id="status"
                        {{ $student->status == 'active' ? 'checked' : '' }} value="active">
                    <label class="form-check-label" for="">Active</label>
                </div>
                <div
                    class="@error('status')
               is-invalid
                @enderror form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status"
                        {{ $student->status == 'blocked' ? 'checked' : '' }} value="blocked">
                    <label class="form-check-label" for="">Blocked</label>
                </div>



                <div class="form-group mt-3">
                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                </div>

</form>






<script type='text/javascript'>
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<script>
    $('#submit').click(function () {
        let counter = 0
        let text = ['loading.', 'loading..', 'loading...', 'loading.', 'loading..', 'loading...']
        const change = () => {
            $('#submit').text(text[counter])
            counter ++
        }
        setInterval(change, 250);
        setTimeout(() => {
            $('#edit').submit()
        }, 1000)

    })

</script>


<!-- End Javascript -->
