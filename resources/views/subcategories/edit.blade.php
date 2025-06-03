@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Edit Sub Category</h3>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Category Selection -->
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control select" name="category_id" required>
                                    <option value="" disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Subcategory Name -->
                            <div class="form-group">
                                <label>Subcategory Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $subcategory->name }}" required>
                            </div>

                            <!-- Category Image -->
                            <div class="form-group">
                                <label>Category Image</label>
                                <input class="form-control" type="file" name="image">
                            </div>

                            <!-- Display Existing Image -->
                            @if($subcategory->image)
                            <div class="form-group">
                                <div class="avatar">
                                    <img class="avatar-img rounded" alt="Subcategory Image"
                                        src="{{ asset('storage/' . $subcategory->image) }}">
                                </div>
                            </div>
                            @endif

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
