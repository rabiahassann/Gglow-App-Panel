@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header mt-5">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Products</h3>
                </div>
                <div class="col-auto text-end">
                   
                    <a href="{{route('product.add')}}" class="btn btn-primary add-button ml-3">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 datatable">
                                @if(isset($products))
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Products</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                      
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$product->name}}
                                        </td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->created_at}}</td>
                                       
                                        <td class="text-center">
                                           
                                            <a href="{{ route('admin.product-edit', ['id' => $product->id]) }}"
                                                class="btn btn-sm bg-success-light">
                                                <i class="far fa-edit me-1"></i> 
                                            </a>
                                            <a href="{{ route('admin.product-destroy', ['id' => $product->id]) }}"
                                                class="btn btn-sm bg-danger-light">
                                                <i class="far fa-trash me-1"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <div class="flex justify-center mt-4">
                               
                            </table>
                            {{ $products->links('vendor.custom-pagination') }}
                            </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.status-toggle-js').on('change', function() {
            alert('test');
            const $toggle = $(this); // Store reference to the toggle element
            const productId = $toggle.data('product-id');
            const status = $toggle.prop('checked') ? 0 : 1;
            
            $.ajax({
                url: `/admin/product/toggle-status/${productId}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    status: status
                },
                success: function(response) {
                    if(response.success) {
                        toastr.success('Status updated successfully');
                    } else {
                        toastr.error('Error updating status');
                        $toggle.prop('checked', !$toggle.prop('checked')); // Revert toggle
                    }
                },
                error: function() {
                    toastr.error('Error updating status');
                    $toggle.prop('checked', !$toggle.prop('checked')); // Revert toggle
                }
            });
        });
    });
</script>
@endsection
