<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #0b3d2e;
            font-family: 'Segoe UI', sans-serif;
            color: #ffffff;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background-color: #1d5f44;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 400px;
        }
        .login-card h3 span {
            color: #64d38b;
        }
        .form-control {
            background-color: #2d5c48;
            color: #fff;
            border: 1px solid #406857;
        }
        .form-control::placeholder {
            color: #bbb;
        }
        .form-control:focus {
            border-color: #64d38b;
            box-shadow: 0 0 0 0.2rem rgba(100, 211, 139, 0.25);
        }
        .btn-primary {
            background-color: #64d38b;
            border: none;
        }
        .btn-primary:hover {
            background-color: #57c17a;
        }
        .text-danger {
            font-size: 0.875rem;
        }
        .alert-danger {
            background-color: #7d3d3d;
            color: #fff;
            border: none;
        }
       .logo-img {
    max-height: 100px;
    width: 100px;
    object-fit: cover;
    border-radius: 10%;
    margin-bottom: 20px;
}

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="d-flex align-items-center justify-content-center mb-4 logo-section">
                <div class="text-start">
                    <h5 class="mb-0">Ggloo</h5>
                </div>
            </div>

            <div class="text-center mb-4">
                <h3>Login <span style="color:#64d38b;">Ggloo</span></h3>
                <p class="text-muted">Access to our dashboard</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Enter your password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
