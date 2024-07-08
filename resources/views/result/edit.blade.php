@include('layouts.header')

<body>

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

    <form method="post" action="{{ route('result.update', $result->id) }}">
        @csrf
        @method('PUT') <!-- Use PUT method for update -->
        <div class="row justify-content-center mt-3">
            <div class="col-md-3 form-group">
                <label for="student_id" class="form-label">Student Name</label>
                <select class="form-select" name="student_id" id="student_id" required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ $student->id == $result->student_id ? 'selected' : '' }}>
                            {{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="roll_no" class="form-label">Roll Number</label>
                <input type="number" name="roll_no" class="form-control" id="roll_no" value="{{ $result->roll_no }}"
                    required />
            </div>
            <div class="col-md-3 form-group">
                <label for="stdclass" class="form-label">Class</label>
                <input type="number" name="stdclass" class="form-control" id="stdclass"
                    value="{{ $result->stdclass }}" required />
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-3 form-group">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="number" name="phone_no" class="form-control" id="phone_no"
                    value="{{ $result->phone_no }}" required />
            </div>
            <div class="col-md-3 form-group">
                <label for="term" class="form-label">Term</label>
                <select class="form-select" name="term" id="term" required>
                    <option value="1" {{ $result->term == 1 ? 'selected' : '' }}>Annual Term</option>
                    <option value="2" {{ $result->term == 2 ? 'selected' : '' }}>Mid Term</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="total_marks" class="form-label">Total Marks</label>
                <input type="number" name="total_marks" class="form-control" id="total_marks"
                    value="{{ $result->total_marks }}" required />
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-3 form-group">
                <label for="obt_marks" class="form-label">Obtained Marks</label>
                <input type="number" name="obt_marks" class="form-control" id="obt_marks"
                    value="{{ $result->obt_marks }}" required />
            </div>
            <div class="col-md-3 form-group">
                <label for="remarks" class="form-label">Remarks</label>
                <input type="text" name="remarks" class="form-control" id="remarks" value="{{ $result->remarks }}"
                    required />
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <input type="submit" value="Update" class="btn btn-primary">
            </div>
        </div>
    </form>

</body>

</html>
