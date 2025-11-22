@extends('layouts.app')

@section('title', 'Create Item')

@section('content')

<h2>Create Item</h2>
   <div class="card">
            <div class="card-body">
                <form id="createItemForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Item Name..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>SKU</label>
                            <input type="text" name="sku" id="sku" class="form-control" placeholder="sku..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="price..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" placeholder="stock..." required>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex flex-column flex-md-row justify-content-end align-items-stretch gap-2 gap-md-3">
                        <button type="submit" class="btn btn-primary">Save Item</button>
                    </div>
                    
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#createItemForm').on('submit', function(e) {
                    e.preventDefault();

                    
                    $.ajax({
                        url: "{{ url('items/store') }}",
                        method: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            name: $('#name').val(),
                            sku: $('#sku').val(),
                            price: $('#price').val(),
                            stock: $('#stock').val(),
                        },
                        success: function(res) {
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
            });
       </script>
@endsection
