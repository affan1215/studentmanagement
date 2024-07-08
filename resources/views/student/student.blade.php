@include('layouts.header')
<script>
    $(document).ready(function() {
        $("#newModal").click(function() {
            $('#SubmitForm')[0].reset();
            $('.btn-success').text('Add');
            $('#id').val('');
        });
        $("#SubmitForm").on('submit', function(e) {
            e.preventDefault();
            var data = $('#SubmitForm').serialize();

            $.ajax({
                url: "savedata",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    data: data
                },
                success: function(response) {
                    $('#respanel').html(response);
                    $('#myModal').modal('hide');
                    $('#SubmitForm')[0].reset();
                    fetchrecords();
                }
            });
        });

        $(document).on('click', '.btn-warning', function(e) {
            e.preventDefault();
            var id = $(this).val();

            $.ajax({
                url: "editdata",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    $('#SubmitForm')[0].reset();
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#roll_no').val(response.roll_no);
                    $('#stdclass').val(response.stdclass);
                    $('#phone_no').val(response.phone_no);
                    $('.btn-success').text('Update');
                    $('#myModal').modal('show');
                    fetchrecords();

                }
            });
        });

        $(document).on('click', '.btn-danger', function(e) {
            e.preventDefault();

            // Display confirmation dialog
            var isConfirmed = confirm("Are you sure you want to delete this item?");

            if (isConfirmed) {
                var id = $(this).val();

                $.ajax({
                    url: "deletedata",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        $('#respanel').html(response);
                        fetchrecords(); // Call the function to refresh records
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                        alert('An error occurred: ' + error);
                    }
                });
            } else {
                // User cancelled the confirmation dialog, do nothing
                console.log("Delete action was cancelled.");
            }
        });


        function fetchrecords() {
            $.ajax({
                url: "getdata",
                type: "GET",
                success: function(response) {
                    var tr = '';
                    for (var i = 0; i < response.length; i++) {
                        var id = response[i].id;
                        var name = response[i].name;
                        var roll_no = response[i].roll_no;
                        var stdclass = response[i].stdclass;
                        var phone_no = response[i].phone_no;
                        tr += '<tr>'
                        tr += '<td>' + id + '</td>'
                        tr += '<td>' + name + '</td>'
                        tr += '<td>' + roll_no + '</td>'
                        tr += '<td>' + stdclass + '</td>'
                        tr += '<td>' + phone_no + '</td>'
                        tr +=
                            '<td> <button type="button" class="btn btn-warning" value= "' +
                            id +
                            '">Edit</button></td>'
                        tr += '<td> <button type="button" class="btn btn-danger" value="' +
                            id +
                            '">Delete</button></td>'
                        tr += '/<tr>'

                    }
                    $('#student_data').html(tr);
                }

            });
        }
        fetchrecords();
    });
</script>

<body>
    <div class="container mb-5">
        <div class="row mt-3">
            <p id="respanel">Click on the button Add Student</p>
            <div class="col">
                <button type="button" id="newModal" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#myModal">
                    Add Student
                </button>
            </div>
            <div class="col-auto">
                <a href="{{ route('result.index') }}" class="btn btn-info">Result</a>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Student Record</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container mt-3">
                        <form id="SubmitForm">
                            <div class="mb-3 mt-3">
                                <input type="hidden" name="id" id="id">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                    name="name">
                            </div>
                            <div class="mb-3">
                                <label for="roll_no">Roll Number</label>
                                <input type="number" class="form-control" id="roll_no"
                                    placeholder="Enter Roll Number" name="roll_no">
                            </div>
                            <div class="mb-3">
                                <label for="stdclass">Class:</label>
                                <input type="number" class="form-control" id="stdclass" placeholder="Enter Class"
                                    name="stdclass">
                            </div>
                            <div class="mb-3">
                                <label for="phone_no">Phone Number</label>
                                <input type="text" class="form-control" id="phone_no"
                                    placeholder="Enter Phone Numnber" name="phone_no">
                            </div>
                            <button type="submit" class="btn btn-success">Add</button>
                        </form>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-10">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-success">
                            <th style="text-align: center;">SR</th>
                            <th style="text-align: center;">Name</th>
                            <th style="text-align: center;">Roll Number</th>
                            <th style="text-align: center;">Class</th>
                            <th style="text-align: center;">Phone Number</th>
                            <th colspan="2" style="text-align: center;">Action</th>

                        </thead>
                        <tbody id="student_data">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
