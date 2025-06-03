@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="page-title">Welcome Admin!</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-primary">
                                <i class="far fa-user"></i>
                            </span>
                            <div class="dash-widget-info">
                                <h3>{{$users ?? '0' }}</h3>
                                <h6 class="text-muted">Subscribed Users</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-primary">
                                <i class="fas fa-user-shield"></i>
                            </span>
                            <div class="dash-widget-info">
                                <h3>{{$categories ?? '0' }}</h3>
                                <h6 class="text-muted">Categories</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-primary">
                                <i class="fas fa-qrcode"></i>
                            </span>
                            <div class="dash-widget-info">
                                <h3>{{$websites ?? '0' }}</h3>
                                <h6 class="text-muted">Websites</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-primary">
                                <i class="far fa-credit-card"></i>
                            </span>
                            <div class="dash-widget-info">
                                <h3>{{$report ?? '0' }}</h3>
                                <h6 class="text-muted">Reported Links</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Chart.js Scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


@endsection
