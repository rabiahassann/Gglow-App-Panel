<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Ggloo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('storage/profiles/j1jsDvZ5Gh9XjKKfwZWV7MyeK1XMaE5Wpva2saEe.png') }}"
        type="image/png">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <style>
    /* Position the messages at the top-right */
    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        /* Ensures it's above other content */
        width: 300px;
        padding: 15px;
        border-radius: 5px;
        opacity: 1;
        transition: opacity 0.5s ease;
    }

    /* Styling for Success */
    .alert-success {
        background-color: #4CAF50;
        color: white;
    }

    .sidebar-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        background-color: #1d5f44;
        /* Dark background for the sidebar */
        color: #fff;
        /* White text color */
        font-family: 'Arial', sans-serif;
        /* Stylish font */
        font-size: 24px;
        /* Larger font size for the brand */
        font-weight: bold;
        /* Make the text bold */
        border-bottom: 2px solid #f1f1f1;
        /* A subtle border below */
        letter-spacing: 2px;
        /* Add space between letters */
        text-transform: uppercase;
        /* Capitalize the text */
    }

    .sidebar-logo h6 {
        margin: 0;
        /* Remove default margin */
    }

    /* Styling for Error */
    .alert-danger {
        background-color: #f44336;
        color: white;
    }

    .sidebar-inner {
        height: 100vh;
        /* Or a fixed height */
        overflow-y: auto;
        /* This enables scroll */
    }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="#" class="logo logo-small">
                    <img src="{{asset('assets/img/logo-icon.png')}}" alt="Logo" width="30" height="30">
                </a>
            </div>
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-align-left"></i>
            </a>
            <a class="mobile_btn" id="mobile_btn" href="javascript:void(0);">
                <i class="fas fa-align-left"></i>
            </a>
            <ul class="nav user-menu">

                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle user-link  nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle"
                                src="{{ asset('storage/' . auth()->user()->pic?? 'assets/img/user1.png') }}" width="40"
                                alt="Admin">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </div>
                </li>

            </ul>
        </div>



        <div class="sidebar" id="sidebar">
            <div class="sidebar-logo d-flex align-items-center gap-2">
                <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo" width="30" height="30">
                <div>
                    <h6 class="mb-0">Ggloo</h6>
                </div>
            </div>
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                            <a href="{{route('dashboard')}}"><i class="fas fa-columns"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li class="{{ request()->is('user/categor*') ? 'active' : '' }}">
                            <a href="{{route('categories.index')}}"><i class="fas fa-layer-group"></i>
                                <span>Categories</span></a>
                        </li>

                        <li class="{{ request()->is('user/subcategor*') ? 'active' : '' }}">
                            <a href="{{ route('subcategories.index') }}">
                                <i class="fas fa-layer-group"></i>
                                <span>Sub Category</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('user/product*') ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">
                                <i class="fas fa-box"></i>
                                <span>Products</span>
                            </a>
                        </li>
                        <li class="mb-5">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </ul>
                </div>
            </div>
        </div>

        @yield('content')
        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <!-- Error Message -->
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

    </div>
    @yield('scripts')

    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/admin.js')}}"></script>
    <script>
    window.onload = function() {
        // Show success and error messages if they exist
        let successMessage = document.getElementById('successMessage');
        let errorMessage = document.getElementById('errorMessage');

        // Show the messages
        if (successMessage) {
            successMessage.style.display = 'block';
            setTimeout(function() {
                successMessage.style.opacity = '0';
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 1000); // Wait for fade out transition to complete
            }, 5000); // Show for 5 seconds
        }

        if (errorMessage) {
            errorMessage.style.display = 'block';
            setTimeout(function() {
                errorMessage.style.opacity = '0';
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 1000); // Wait for fade out transition to complete
            }, 5000); // Show for 5 seconds
        }
    };
    </script>
</body>

</html>