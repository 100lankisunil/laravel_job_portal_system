@extends("layouts.master")

@section('main-content')

@if(Auth::user()->role === "employer")


<div class="container" style="margin-top: 100px;">
    <div class="card-body pt-2">
        <div class="table-responsive">
            <table class="table align-middle table-nowrap mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>description</th>
                        <th>Requirement</th>
                        <th>Salary Range(&#x20B9;)</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $row )

                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>
                            <p class="mb-0">{{ $row->title }}</p>
                        </td>
                        <td>
                            {{ $row->description }}
                        </td>
                        <td>
                            {{ $row->requirements }}
                        </td>
                        <td>
                            {{ $row->salary_range }}{{ "K" }}
                        </td>
                        <td>
                            {{ $row->location }}
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
                            <label for="titleInput" class="form-label">Title</label>
                            <input type="text" class="form-control" id="titleInput" placeholder="Enter your name" required name="title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter Description" required name="description">
                        </div>
                        <div class="mb-3">
                            <label for="requirements" class="form-label">Requirements</label>
                            <input type="text" class="form-control" id="requirements" placeholder="Enter Requirements" required name="requirements">
                        </div>
                        <div class="mb-3">
                            <label for="salary_range" class="form-label">Salary Range</label>
                            <input type="text" class="form-control" id="salary_range" placeholder="Enter your email" required name="salary_range">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" placeholder="Enter your email" required name="location">
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
                , url: "{{ route('editJobs') }}"
                , data: {
                    id: id
                }
                , success: function(response) {
                    console.log(response.data[0]);
                    $('#id').val(response.data[0].id);
                    $("#titleInput").val(response.data[0].title);
                    $("#description").val(response.data[0].description);
                    $("#requirements").val(response.data[0].requirements);
                    $("#salary_range").val(response.data[0].salary_range);
                    $("#location").val(response.data[0].location);
                }
                , error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(document).on("click", "#savebtn", function() {
            var id = $('#id').val();
            var title = $("#titleInput").val();
            var description = $("#description").val();
            var requirements = $("#requirements").val();
            var salary_range = $("#salary_range").val();
            var location = $("#location").val();

            $.ajax({
                type: "post"
                , url: "{{ route('updateJobs') }}"
                , data: {
                    id: id
                    , title: title
                    , description: description
                    , requirements: requirements
                    , salary_range: salary_range
                    , location: location
                }
                , success: function(response) {
                    if (response.status == true) {
                        Swal.fire({
                            title: "Update successfully"
                            , icon: "success"
                            , draggable: true
                        });
                        location.reload();
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
                        , url: "{{ route('deleteJobs') }}"
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


@endsection('main-content')
