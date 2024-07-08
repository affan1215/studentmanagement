@include('layouts.header')

<body>

<div class="container mt-3 mb-5">
    <div class="row mt-5">
        <div class="col">
            <a href="{{ url('student') }}" class="btn btn-primary btn-block">Student</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('result.create') }}" class="btn btn-info">Add Result</a>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row justify-content-center mt-10">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-success">
                        <th style="text-align: center;">SR</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Roll Number</th>
                        <th style="text-align: center;">Class</th>
                        <th style="text-align: center;">Phone Number</th>
                        <th style="text-align: center;">Total Marks</th>
                        <th style="text-align: center;">Obtained Marks</th>
                        <th style="text-align: center;">Percentage</th>
                        <th style="text-align: center;">Term</th>
                        <th style="text-align: center;">Remarks</th>
                        <th colspan="2" style="text-align: center;">Action</th>

                    </thead>
                    <tbody>
                        @foreach ($results as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->student->name }}</td>
                                <td>{{ $value->roll_no }}</td>
                                <td>{{ $value->stdclass }}</td>
                                <td>{{ $value->phone_no }}</td>
                                <td>{{ $value->total_marks }}</td>
                                <td>{{ $value->obt_marks }}</td>
                                <td>{{ number_format(($value->obt_marks * 100) / $value->total_marks, 1) }}</td>
                                <td>{{ $value->remarks }}</td>
                                <td>
                                    @if ($value->term == 1)
                                        Annual Term
                                    @else
                                        Mid Term
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('result.edit', $value->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('result.destroy', $value->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</body>
