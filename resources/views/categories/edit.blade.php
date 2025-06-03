@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Edit Category</h3>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" type="text" value="{{$category->name}}" name="name">
                            </div>
                            <div class="form-group">
                                <label>Category Image</label>
                                <input class="form-control" type="file" name="image">
                            </div>
                            <div class="form-group">
                                <div class="avatar">
                                <img class="rounded service-img me-1"
                                                src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                <a href="javascript:history.back()" class="btn btn-link">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection