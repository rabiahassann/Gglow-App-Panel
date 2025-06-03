@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Add Listing</h3>
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

                        <form action="{{ route('admin.store-product') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Category -->
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Subcategory -->
                            <div class="form-group" id="subCategoryWrapper" style="display:none">
                                <label>Sub Category</label>
                                <select class="form-control" name="sub_category_id" id="subcategory-select">
                                    <option value="" disabled selected>Select Subcategory</option>
                                </select>
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label>Listing Title</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <!-- Images -->
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" class="form-control" name="images[]" multiple required>
                            </div>

                            <!-- Price -->
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" step="0.01" required>
                            </div>

                            <!-- Location -->
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" class="form-control" name="location" required>
                            </div>

                            <!-- Number -->
                            <div class="form-group">
                                <label>Number</label>
                                <input type="text" class="form-control" name="number" required>
                            </div>

                            <!-- Overview -->
                            <div class="form-group">
                                <label>Overview</label>
                                <textarea class="form-control" name="overview" rows="4" ></textarea>
                            </div>

                            <!-- Entry Access -->
                            <div class="form-group">
                                <label>Entry Access</label>
                                <textarea class="form-control" name="entry_access" rows="4" ></textarea>
                            </div>

                            <!-- Exclusive Benefits -->
                            <div class="form-group">
                                <label>Exclusive Benefits</label>
                                <textarea class="form-control" name="exlusive_benefits" rows="4" ></textarea>
                            </div>

                            <!-- Kids Nannyxs -->
                            <div class="form-group">
                                <label>Kids Nannyxs</label>
                                <textarea class="form-control" name="kids_nannyxs" rows="4" ></textarea>
                            </div>

                            <!-- Listing Type -->
                            <div class="form-group">
                                <label>Listing Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="listing_type[]" value="featured" id="featured">
                                    <label class="form-check-label" for="featured">Featured</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="listing_type[]" value="best_deals" id="best_deals">
                                    <label class="form-check-label" for="best_deals">Best Deals</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="listing_type[]" value="family_social" id="family_social">
                                    <label class="form-check-label" for="family_social">Family Social</label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Add Product</button>
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
    document.addEventListener("DOMContentLoaded", function () {
        const APP_URL = "{{ url('/') }}";

        document.querySelector("select[name='category_id']").addEventListener("change", function () {
            let categoryId = this.value;
            fetch(`${APP_URL}/get-subcategories/${categoryId}`)
                .then(res => res.json())
                .then(data => {
                    let subSelect = document.getElementById("subcategory-select");
                    subSelect.innerHTML = '<option value="" disabled selected>Select Subcategory</option>';
                    if (data.length > 0) {
                        document.getElementById("subCategoryWrapper").style.display = 'block';
                        data.forEach(item => {
                            subSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                        });
                    } else {
                        document.getElementById("subCategoryWrapper").style.display = 'none';
                    }
                });
        });
    });
</script>


@endsection
