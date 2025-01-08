@extends("layouts.master")

@section('main-content')

@if(Auth::user()->role === "employer")
<div class="container" style="margin-top: 100px;">
    <div class="card-body pt-2">
        <div class="table-responsive">
            <table class="table align-middle table-nowrap mb-0 table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Application Id</th>
                        <th>Job Title</th>
                        <th>Poted By</th>
                        <th>Applied By</th>
                        <th>Posted Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $row )
                    <tr>
                        <td>{{ $row->applicationId }}</td>
                        <td>
                            <p class="mb-0">{{ $row->title }}</p>
                        </td>
                        <td>
                            {{ $row->posted_by }}
                        </td>
                        <td>
                            {{ $row->name }}
                        </td>
                        <td>
                            {{ $row->formatted_date }}
                        </td>
                        <td>
                            <div class="border border-bottom border-info rounded text-center">
                                {{ $row->status }}
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success approve" data-id="{{ $row->applicationId }}">Approve</button>
                            <button type="button" class="btn btn-danger rejected" data-id="{{ $row->applicationId }}">Rejected</button>
                            {{-- <button type="button" class="btn btn-warning pending" data-id="{{ $row->applicationId }}">Pendding</button> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- end table-responsive -->
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

        $(document).on('click', ".approve", function() {
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?"
                , text: "You want to Approve!"
                , icon: "info"
                , showCancelButton: true
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: "Yes, Approve!"
            }).then((result) => {
                $.ajax({
                    type: "POST"
                    , url: "{{ route('approve') }}"
                    , data: {
                        id: id
                    }
                    , success: function(response) {
                        console.log(response);
                        if (response.status == true) {
                            Swal.fire({
                                title: "Approved!"
                                , icon: "success"
                            });
                            location.reload();
                        }
                        if (response.status == false) {
                            Swal.fire({
                                title: "Error"
                                , text: "Application not approved"
                                , icon: "error"
                            });
                            location.reload();
                        }

                    }
                    , error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });


        $(document).on('click', ".rejected", function() {
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?"
                , text: "You want to rejected!"
                , icon: "warning"
                , showCancelButton: true
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: "Yes, rejected!"
            }).then((result) => {
                $.ajax({
                    type: "POST"
                    , url: "{{ route('rejected') }}"
                    , data: {
                        id: id
                    }
                    , success: function(response) {
                        console.log(response);
                        if (response.status == true) {
                            Swal.fire({
                                title: "Rejected!"
                                , icon: "success"
                            });
                            location.reload();
                        }
                        if (response.status == false) {
                            Swal.fire({
                                title: "Error"
                                , text: "Application not rejected"
                                , icon: "error"
                            });
                            location.reload();
                        }

                    }
                    , error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        $(document).on('click', ".pending", function() {
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?"
                , text: "You want to pending this!"
                , icon: "warning"
                , showCancelButton: true
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: "Yes!"
            }).then((result) => {
                $.ajax({
                    type: "POST"
                    , url: "{{ route('pending') }}"
                    , data: {
                        id: id
                    }
                    , success: function(response) {
                        console.log(response);
                        if (response.status == true) {
                            Swal.fire({
                                title: "pending!"
                                , icon: "success"
                            });
                            location.reload();
                        }
                        if (response.status == false) {
                            Swal.fire({
                                title: "Error"
                                , text: "Application not pending"
                                , icon: "error"
                            });
                            location.reload();
                        }

                    }
                    , error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

    });

</script>



@endif


@endsection('main-content')
