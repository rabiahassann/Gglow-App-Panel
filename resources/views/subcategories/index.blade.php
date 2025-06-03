
@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Sub Categories</h3>
                </div>
                <div class="col-auto text-end">
                    
                    <a href="{{route('subcategory.add')}}" class="btn btn-primary add-button ml-3">
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
                            @if(isset($categories))
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sub Category</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $cat)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <img class="rounded service-img me-1"
                                                src="{{ asset('storage/' . $cat->image) }}" alt="Category Image"
                                                style="width: 50px; height: 50px; object-fit: cover;">

                                            {{$cat->name}}
                                        </td>
                                        <td>{{$cat->category->name}}</td>
                                        <td>{{$cat->created_at}}</td>
                                        <td class="text-end">
                                        <a href="{{ route('subcategory.edit', $cat->id) }}"
                                                class="btn btn-sm bg-success-light me-2">
                                                <i class="far fa-edit me-1"></i>
                                            </a>

                                            <form action="{{ route('subcategory.destroy', $cat->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm bg-danger-light me-2">
                                                    <i class="far fa-trash me-1"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="flex justify-center mt-4">
                                {{ $categories->links('vendor.custom-pagination') }}
                            </div>
                            @else
                            <p>No Data Found</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection