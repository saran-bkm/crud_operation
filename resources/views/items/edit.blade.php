@extends('layouts.app')

@section('title', 'Update Item')

@section('content')

<h2>Update Item</h2>
   <div class="card">
            <div class="card-body">
                <form id="UpdateItemForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$items->name}}" placeholder="Item Name..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>SKU</label>
                            <input type="text" name="sku" id="sku" class="form-control"  value="{{$items->sku}}" placeholder="sku..." required readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" name="price" id="price" value="{{$items->price}}" class="form-control" placeholder="price..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Stock</label>
                            <input type="number" name="stock" id="stock" value="{{$items->stock}}" class="form-control" placeholder="stock..." required>
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
                $('#UpdateItemForm').on('submit', function(e) {
                    e.preventDefault();

                   let id = '@json($items->id)';
                    $.ajax({
                        url: "{{ url('items/update') }}",
                        method: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id : id,
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
