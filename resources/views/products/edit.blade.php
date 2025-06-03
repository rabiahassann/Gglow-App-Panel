@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Edit Listing</h3>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <!-- Show validation errors -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('admin.product-update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id" required>
                                    <option value="" disabled>Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="subCategoryWrapper" style="display:block">
                                <label>Sub Category</label>
                                <select class="form-control" name="sub_category_id" id="subcategory-select">
                                    <option value="" disabled>Select Subcategory</option>
                                    @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label>Listing Title</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                                    required>
                            </div>

                            @php
                            $images = json_decode($product->images, true);
                            @endphp

                            @if(is_array($images))
                            <div class="form-group">
                                <label>Existing Images</label>
                                <div class="row">
                                    @foreach($images as $image)
                                    <div class="col-md-3 mb-2">
                                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid img-thumbnail"
                                            alt="Image">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif



                            <div class="form-group">
                                <label>Upload New Images (Optional)</label>
                                <input type="file" class="form-control" name="images[]" multiple>
                            </div>

                            <!-- Price -->
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" step="0.01"
                                    value="{{ $product->price }}" required>
                            </div>

                            <!-- Location -->
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" class="form-control" name="location" value="{{ $product->location }}"
                                    required>
                            </div>

                            <!-- Number -->
                            <div class="form-group">
                                <label>Number</label>
                                <input type="text" class="form-control" name="number" value="{{ $product->number }}"
                                    required>
                            </div>

                            <!-- Overview -->
                            <div class="form-group">
                                <label>Overview</label>
                                <textarea class="form-control" name="overview"
                                    rows="4">{{ $product->overview }}</textarea>
                            </div>

                            <!-- Entry Access -->
                            <div class="form-group">
                                <label>Entry Access</label>
                                <textarea class="form-control" name="entry_access"
                                    rows="4">{{ $product->entry_access }}</textarea>
                            </div>

                            <!-- Exclusive Benefits -->
                            <div class="form-group">
                                <label>Exclusive Benefits</label>
                                <textarea class="form-control" name="exlusive_benefits"
                                    rows="4">{{ $product->exlusive_benefits }}</textarea>
                            </div>

                            <!-- Kids Nannyxs -->
                            <div class="form-group">
                                <label>Kids Nannyxs</label>
                                <textarea class="form-control" name="kids_nannyxs"
                                    rows="4">{{ $product->kids_nannyxs }}</textarea>
                            </div>

                            <!-- Listing Type -->
                            <div class="form-group">
                                <label>Listing Type</label>
                                @php
                                $types = is_array($product->type) ? $product->type : json_decode($product->type, true)
                                ?? [];
                                @endphp

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="listing_type[]"
                                        value="featured" {{ in_array('featured', $types) ? 'checked' : '' }}>
                                    <label class="form-check-label">Featured</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="listing_type[]"
                                        value="best_deals" {{ in_array('best_deals', $types) ? 'checked' : '' }}>
                                    <label class="form-check-label">Best Deals</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="listing_type[]"
                                        value="family_social" {{ in_array('family_social', $types) ? 'checked' : '' }}>
                                    <label class="form-check-label">Family Social</label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                                <a href="{{ route('products.index') }}" class="btn btn-link">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const APP_URL = "{{ url('/') }}";

    document.querySelector("select[name='category_id']").addEventListener("change", function() {
        let categoryId = this.value;
        fetch(`${APP_URL}/get-subcategories/${categoryId}`)
            .then(res => res.json())
            .then(data => {
                let subSelect = document.getElementById("subcategory-select");
                subSelect.innerHTML = '<option value="" disabled>Select Subcategory</option>';
                if (data.length > 0) {
                    document.getElementById("subCategoryWrapper").style.display = 'block';
                    data.forEach(item => {
                        subSelect.innerHTML +=
                            `<option value="${item.id}">${item.name}</option>`;
                    });
                } else {
                    document.getElementById("subCategoryWrapper").style.display = 'none';
                }
            });
    });
});
</script>

@endsection