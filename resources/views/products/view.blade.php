@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="service-header">
                            <div class="service-inner">
                                <h2>{{$product->name ?? ''}}</h2>

                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="d-inline-block average-rating">(4)</span>
                                </div>
                                <div class="service-cate">
                                    <a href="javascript:void(0);">{{$product->category->name ?? ''}}</a>
                                </div>
                            </div>
                            <div class="service-amount">
                                <span>${{$product->price ?? ''}}</span>
                            </div>
                        </div>

                        <div class="service-description">
                            <!-- Primary Image (Larger) -->
                            <div class="primary-image text-center mb-4">
                                <img src="{{ asset('storage/' . $product->primary_image) }}" alt="Primary Image"
                                    class="img-fluid"
                                    style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 10px;">
                            </div>
                            <h5 class="card-title mt-4">Product Description</h5>
                            <p class="mb-0">{{$product->description ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card available-widget">
                    <div class="card-body">
                        <h5 class="card-title">Product Details</h5>

                        <!-- Colors Section -->
                        @php
                        $colors = is_string($product->colors) ? json_decode($product->colors, true) : [];
                        $colors = array_map(function($color) {
                        if (is_array($color)) {
                        return reset($color);
                        }
                        return trim($color, '"[]\\');
                        }, $colors);
                        $colors = array_filter($colors, function($color) {
                        return !empty($color) && strpos($color, '#') === 0;
                        }); @endphp
                        @if (!empty($colors))
                        <h6>Available Colors:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($colors as $color)
                            <span class="badge px-3 py-2"
                                style="background-color: {{ $color }}; color: #fff; border-radius: 5px;">
                                {{ ucfirst($color) }}
                            </span>
                            @endforeach
                        </div>
                        @else
                        <p>No colors available.</p>
                        @endif

                        <!-- Sizes Section -->
                        <h6 class="mt-3">Available Sizes:</h6>
                        @if(!empty($product->sizes) && json_decode($product->sizes) != [""])

                        @php
                        $sizes = json_decode($product->sizes, true);
                        $sizes = array_filter($sizes); // This will remove empty values
                        @endphp
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($sizes as $size)
                            <span class="badge bg-secondary px-3 py-2">
                                {{ strtoupper($size) }}
                            </span>
                            @endforeach
                        </div>
                        @endif

                        <!-- Additional Product Info -->
                        <h6 class="mt-3">Why Choose This Product?</h6>
                        <p class="text-muted">Our {{ $product->name ?? 'product' }} is crafted with premium materials,
                            offering durability and style. Available in multiple colors and sizes to fit your needs.</p>
                        @php
                        $otherImages = json_decode($product->other_images, true);
                        @endphp

                        @if (!empty($otherImages))
                        <h5 class="mt-4">Gallery Images</h5>
                        <div class="row">
                            @foreach ($otherImages as $image)
                            <div class="col-md-6 mb-3">
                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" class="img-fluid"
                                    style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection