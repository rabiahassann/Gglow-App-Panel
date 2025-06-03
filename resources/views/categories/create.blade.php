@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Add Category</h3>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                    <form action="{{ route('categories.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Category Image</label>
                                <input class="form-control" type="file" name="image" required>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary" type="submit">Add Category</button>
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