@include('layouts.header')
<script>
    $(document).ready(function() {
        $('#student_id').change(function() {
            var student_id = $(this).val();
            if (student_id) {
                $.ajax({
                    url: '/getStudentDetails/' + student_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#roll_no').val(data.roll_no);
                        $('#stdclass').val(data.stdclass);
                        $('#phone_no').val(data.phone_no);
                    }
                });
            } else {
                $('#roll_no').val('');
                $('#stdclass').val('');
                $('#phone_no').val('');
            }
        });
    });
</script>

<body>

</body>
<div class="container mt-3 mb-5">
    <div class="row mt-5">
        <div class="col">
            <a href="{{ url('student') }}" class="btn btn-primary btn-block">Student</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('result.index') }}" class="btn btn-info">View All</a>
        </div>
    </div>
</div>

<form method="post" action="{{ route('result.store') }}">
    @csrf
    <div class="row justify-content-center mt-10">
        <div class="col-md-3 form-group">
            <label for="student_id" class="form-label"> Student Name</label>
            <select class="form-select" name="student_id" id="student_id" required>
                <option value="" hidden selected disabled>Choose Option</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 form-group">
            <label for="roll_no" class="form-label">Roll Number</label>
            <input type="number" name="roll_no" class="form-control" id="roll_no" required disabled/>
        </div>
        <div class="col-md-3 form-group">
            <label for="stdclass" class="form-label">Class</label>
            <input type="number" name="stdclass" class="form-control" id="stdclass" required disabled/>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-3 form-group">
            <label for="phone_no" class="form-label">Phone Number</label>
            <input type="number" name="phone_no" class="form-control" id="phone_no" required disabled/>
        </div>
        <div class="col-md-3 form-group">
            <label for="term" class="form-label">Term</label>
            <select class="form-select" aria-label="Disabled select example" name="term" id="term" required>
                <option value="" hidden selected disabled>Choose Option</option>
                <option value="1">Annual Term</option>
                <option value="2">Mid Term</option>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label for="total_marks" class="form-label">Total Marks</label>
            <input type="number" name="total_marks" class="form-control" id="total_marks" required />
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-3 form-group">
            <label for="obt_marks" class="form-label">Obtained Marks</label>
            <input type="number" name="obt_marks" class="form-control" id="obt_marks" required />
        </div>
        <div class="col-md-3 form-group">
            <label for="remarks" class="form-label">Remarks</label>
            <input type="text" name="remarks" class="form-control" id="remarks" required />
        </div>

    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </div>



</form>
