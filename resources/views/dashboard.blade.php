@extends("layouts.master")

@section('main-content')


@if(Auth::user()->role === "admin")
<div class="container" style="margin-top:100px">
    <div class="row ">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex pb-0">
                    <h4 class="card-title mb-0 flex-grow-1">Latest Transaction</h4>
                    <div>
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold">Sort By:</span>
                                <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Yearly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                                <a class="dropdown-item" href="#">Today</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row )

                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>
                                        <p class="mb-0">{{ $row->name }}</p>
                                    </td>
                                    <td>
                                        {{ $row->email }}
                                    </td>
                                    <td>
                                        {{ $row->role }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <i class="mdi mdi-pencil btn btn-primary edit" data-id="{{ $row->id }}" data-bs-target="#exampleModal" data-bs-toggle="modal"></i>
                                            <i class="mdi mdi-delete btn btn-danger delete" data-id="{{ $row->id }}"></i>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="modalForm">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <div class="mb-3">
                                        <label for="nameInput" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="nameInput" placeholder="Enter your name" required name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" required name="email">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Save changes" id="savebtn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on("click", ".edit", function() {
            var id = $(this).attr('data-id');
            //console.log(id);
            $.ajax({
                type: "get"
                , url: "{{ route('editUser') }}"
                , data: {
                    id: id
                }
                , success: function(response) {
                    //console.log(data.data.name);
                    $('#id').val(response.data.id);
                    $("#nameInput").val(response.data.name);
                    $("#emailInput").val(response.data.email);
                }
                , error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(document).on("click", "#savebtn", function() {
            var id = $('#id').val();
            var name = $("#nameInput").val();
            var email = $("#emailInput").val();
            $.ajax({
                type: "post"
                , url: "{{ route('updateUser') }}"
                , data: {
                    id: id
                    , name: name
                    , email: email
                }
                , success: function(response) {
                    if (response.status == true) {
                        Swal.fire({
                            title: "Update successfully"
                            , icon: "success"
                            , draggable: true
                        });
                        location.reload();
                        // refreshTable();
                    }
                    if (response.status == false) {
                        Swal.fire({
                            icon: "error"
                            , title: "Oops..."
                            , text: "Updation failed"
                        });
                    }
                }
                , error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });



        $(document).on("click", ".delete", function() {
            var id = $(this).attr('data-id');
            //console.log(id);

            Swal.fire({
                title: "Are you sure?"
                , text: "You won't be able to revert this!"
                , icon: "warning"
                , showCancelButton: true
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get"
                        , url: "{{ route('deleteUser') }}"
                        , data: {
                            id: id
                        }
                        , success: function(response) {
                            if (response.status == true) {
                                Swal.fire({
                                    title: "Delete successfully"
                                    , icon: "success"
                                    , draggable: true
                                });
                                location.reload();
                            }
                            if (response.status == false) {
                                Swal.fire({
                                    icon: "error"
                                    , title: "Oops..."
                                    , text: "Deletion failed"
                                });
                            }
                        }
                        , error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });


        });

    });

</script>
@endif

@if(Auth::user()->role === "employer")

<div class="container" style="margin:100px 0px">
    <section>
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center text-white">
                        <h4>Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <!-- Employer Avatar -->
                            <img src="http://localhost:8000/assets/images/users/avatar-2.jpg" alt="Avatar" class="rounded-circle mb-3" width="100">
                        </div>
                        <h5 class="text-center">{{ Auth::user()->name }}</h5>
                        <p class="text-center text-muted">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
    </section>


    <section>
        <div>
            <h2>Post The Job</h2>
        </div>
        <div class="container">
            <form id="postJobForm" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="jobTitle" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="jobTitle" name="title" placeholder="Enter job title">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter job description"></textarea>
                </div>

                <div class="mb-3">
                    <label for="requirements" class="form-label">Requirements</label>
                    <textarea class="form-control" id="requirements" name="requirements" rows="3" placeholder="Enter job requirements"></textarea>
                </div>

                <div class="mb-3">
                    <label for="salaryRange" class="form-label">Salary Range(&#x20B9;)</label>
                    <input type="text" class="form-control" id="salaryRange" name="salary_range" placeholder="Enter salary range (e.g.,1K - 10K)">
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter job location">
                </div>

                <div class="mb-3">
                    <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" name="posted_by">
                </div>

                <input type="submit" class="btn btn-primary" value="Post Job">
            </form>
        </div>
    </section>

</div>

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Initialize form validation
        $("#postJobForm").validate({
            rules: {
                title: {
                    required: true
                    , minlength: 3
                }
                , description: {
                    required: true
                    , minlength: 10
                }
                , requirements: {
                    required: true
                    , minlength: 5
                }
                , salary_range: {
                    required: true

                }
                , location: {
                    required: true
                    , minlength: 5
                }
            }
            , messages: {
                title: {
                    required: "Please enter a job title"
                    , minlength: "Job title must be at least 3 characters long"
                }
                , description: {
                    required: "Please provide a job description"
                    , minlength: "Description must be at least 10 characters long"
                }
                , requirements: {
                    required: "Please specify the job requirements"
                    , minlength: "Requirements must be at least 5 characters long"
                }
                , salary_range: {
                    required: "Please provide the salary range"
                    , pattern: "Enter valid salary"
                }
                , location: {
                    required: "Please specify the job location"
                }
            }
            , errorElement: "div"
            , errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            }
            , highlight: function(element) {
                $(element).addClass("is-invalid");
            }
            , unhighlight: function(element) {
                $(element).removeClass("is-invalid");
            }
            , submitHandler: function(form, event) {
                event.preventDefault()
                var formData = $(form).serialize();

                // Make AJAX request to submit form data
                $.ajax({
                    url: "{{ route('postJob') }}"
                    , type: 'POST'
                    , data: formData
                    , success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                title: "Job posted successfully"
                                , icon: "success"
                                , draggable: true
                            }).then(() => {
                                $("#postJobForm")[0].reset();
                            });
                        } else if (response.status == false) {
                            Swal.fire({
                                icon: "error"
                                , title: "Oops..."
                                , text: "Failed to post job"
                            });
                        } else if (response.message == 'You are not logged in') {
                            Swal.fire({
                                icon: "error"
                                , title: "Oops..."
                                , text: "Your are not login"
                            });
                        }

                    }
                    , error: function(xhr, status, error) {
                        // Handle any errors here
                        console.log(xhr, status, error);
                    }
                });
            }
        });
    });

</script>




@endif

@endsection('main-content')
