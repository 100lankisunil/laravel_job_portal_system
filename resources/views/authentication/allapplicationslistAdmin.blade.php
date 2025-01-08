@extends("layouts.master")

@section('main-content')

@if(Auth::user()->role === "admin")
<div class="container" style="margin-top: 100px;">
    <div class="card-body pt-2">
        <div class="table-responsive">
            <table class="table align-middle table-nowrap mb-0" id="example">
                <thead>
                    <tr>
                        <th>Application Id</th>
                        <th>Job Title</th>
                        <th>Poted By</th>
                        <th>Applied By</th>
                        <th>Posted Date</th>
                        <th>Status</th>
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
                            {{ $row->status }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- end table-responsive -->
    </div>
</div>


@endif


@endsection('main-content')

@section('page-specific-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('page-specific-scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

</script>
@endsection
