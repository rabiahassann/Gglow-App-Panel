@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Categories</h3>
                </div>
                <div class="col-auto text-end">

                    <a href="{{route('categories.add')}}" class="btn btn-primary add-button ms-3">
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
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td>
                                            <img class="rounded service-img me-1"
                                                src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                                                style="width: 50px; height: 50px; object-fit: cover;">

                                            {{$category->name}}
                                        </td>
                                        <td>{{$category->created_at}}</td>
                                        <td class="text-center">
                                            <a href="{{ route('category.edit', $category->id) }}"
                                                class="btn btn-sm bg-success-light me-2">
                                                <i class="far fa-edit me-1"></i>
                                            </a>

                                            <form action="{{ route('category.destroy', $category->id) }}"
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

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection