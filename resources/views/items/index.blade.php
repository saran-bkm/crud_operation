@extends('layouts.app')

@section('title', 'Items')

@section('content')
   
<div class="row mb-3">
            <div class="col-12 d-flex flex-column flex-md-row justify-content-end align-items-stretch gap-2 gap-md-3">

            <form id="bulkUploadForm" class="d-flex flex-column flex-md-row align-items-stretch gap-2" enctype="multipart/form-data">
                    <input type="file" name="file" class="form-control flex-grow-1" accept=".csv,.xlsx" required>

                    <button type="submit" class="btn btn-success flex-shrink-0">
                        Upload
                    </button>
                </form>

                <a href="{{ url('items/add') }}" 
                class="btn btn-success flex-shrink-0">
                    Add +
                </a>
            </div>
       </div>
        
        
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="ItemsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>SKU</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i->name }}</td>
                        <td>₹ {{ $i->price }}</td>
                        <td>{{ $i->sku }}</td>
                        <td>{{ $i->stock }}</td>
                        <td>
                            <a href="{{ url('items/edit/'.$i->id) }}">
                                <i class="fa fa-edit me-2"></i>
                            </a>   
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
                $('#ItemsTable').DataTable({
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
            $('#bulkUploadForm').on('submit', function(e){
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ url('items/bulk-upload') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(res){
                        toastr.success(res.message);
                            window.location.href = '/items';
                    },

                    error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    toastr.error(value[0]);
                                });
                            } else {
                                        toastr.error("Something went wrong!");
                            }
                        }
                });
            });

        </script> 


@endsection
