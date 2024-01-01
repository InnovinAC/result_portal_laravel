<form id='edit' action="{{ route('edit-subject', $subject->id) }}" method="POST">
    @csrf

    <div class="form-floating mb-3">
        <input
            value="{{ $subject->name }}"
            type="text"
            class="@error('name')
          is-invalid
          @enderror form-control" name="name" id="name" placeholder="">
        <label for="name">Subject Name <span class="text-vermillion">*</span></label>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


</form>

<script>
    $('#submit').click(function () {
        let counter = 0
        let text = ['loading.', 'loading..', 'loading...']
        const change = () => {
            $('#submit').text(text[counter])
            if (text.length == (counter + 1)) {
                counter = 0
            } else {
                counter++
            }
        }
        setInterval(change, 200);
        setTimeout(() => {
            $('#edit').submit()
        }, 1000)

    })

</script>



