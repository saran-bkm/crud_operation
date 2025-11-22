@extends('layouts.app')

@section('title', 'Customers')

@section('content')

<div class="row mb-3">
    <div class="col-12 d-flex flex-column flex-md-row justify-content-end align-items-stretch gap-2 gap-md-3">
        <a href="{{ url('customers/export') }}" 
        class="btn btn-success flex-shrink-0">
            Export Excel
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="customersTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Orders</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($customers as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->phone }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $c->orders->count() }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
            $(document).ready(function() {
                $('#customersTable').DataTable({
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'copy', 
                    //     'csv', 
                    //     'excel', 
                    //     'pdf', 
                    //     'print'
                    // ],
                    pageLength: 10,
                    ordering: true,
                    searching: true,
                    lengthMenu: [5, 10, 25, 50, 100]
                });
            });
        </script> 
@endsection
