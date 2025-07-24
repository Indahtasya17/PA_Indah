<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Login</title>
    <style>
        html,
        body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            /* Optional: A nice sans-serif font */
        }

        body {
            background-color: #f0f2f5;
            /* A light, neutral background for the page */
        }

        .left-column-bg {
            /* --- Updated Background for Left Column --- */
            background-image: url('https://images.unsplash.com/photo-1557682250-33bd709cbe85?auto=format&fit=crop&w=1920&q=80');
            /* Replace with your desired image */
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Adding an overlay to the left column background for better text readability if needed */
        .left-column-bg::before {
            content: '';
            position: absolute;
            /* This requires .left-column-bg to have position: relative or be a flex/grid item that establishes a new formatting context */
            inset: 0;
            /* Covers the entire parent */
            background-color: rgba(0, 0, 0, 0.3);
            /* Dark overlay, adjust opacity as needed */
        }

        /* Ensure content in left column is above the overlay */
        .left-column-bg>* {
            position: relative;
            /* or z-index: 1; */
        }

        .login-form-container .card {
            border: none;
            /* Remove default card border */
            border-radius: 0.75rem;
            /* Softer border radius */
        }

        .btn-custom-login {
            background-color: #20c997;
            /* A nice teal color */
            border-color: #20c997;
            color: white;
        }

        .btn-custom-login:hover {
            background-color: #1baa80;
            /* Darker shade on hover */
            border-color: #1baa80;
            color: white;
        }

        /* --- Style for Show/Hide Password Icon --- */
        .form-floating {
            position: relative;
            /* Needed for absolute positioning of the icon */
        }

        .password-toggle-icon {
            position: absolute;
            top: 50%;
            right: 1rem;
            /* Adjust as needed for padding */
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 100;
            /* Ensure it's above the input field's border/focus shadow */
            color: #6c757d;
            /* Bootstrap's text-muted color */
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            <!-- Left Column: Branding/Image -->
            <div class="col-lg-7 d-none d-lg-flex left-column-bg p-5 position-relative flex-column justify-content-center">
                {{-- You can place a logo or more elaborate branding here --}}
                {{-- <img src="{{ asset('assets/img\Logo_holena.png') }}" alt="Company Logo" class="mb-12" --}}
                    {{-- style="max-width: 150px; border-radius: 0.5rem;"> --}}
                <h1 class="display-5 fw-bold mb-3">Selamat Datang Kembali</h1>
                {{-- <p class="lead mb-4">Log in to continue to your dashboard and manage your account.</p> --}}
            </div>

            <!-- Right Column: Login Form -->
            <div class="col-lg-5 d-flex flex-column align-items-center justify-content-center p-4 login-form-container">
                <div class="card shadow-lg w-100" style="max-width: 480px;">
                    <div class="card-body p-4 p-sm-5">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/img\Logo_holena.png') }}" alt="Company Logo" class="mb-12"
                                style="max-width: 300px; border-radius: 0.5rem;">
                            <p class="text-muted">Silahkan Masukan Username dan Password</p>
                        </div>

                        <form action="{{ route('login.process') }}" method="POST">
                            @csrf

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {!! session('error') !!}
                                </div>
                            @endif

                            @if ($errors->any() && !session('error'))
                                <div class="alert alert-danger" role="alert">
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" id="username" placeholder="Username" value="{{ old('username') }}"
                                    required autofocus>
                                <label for="username">Username</label>
                                @error('username')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Password" required
                                    style="padding-right: 3rem;">
                                <label for="password">Password</label>
                                <i class="bi bi-eye-slash password-toggle-icon" id="togglePassword"></i>
                                @error('password')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-custom-login btn-lg fw-medium" type="submit">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function (e) {
                    // toggle the type attribute
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    // toggle the icon
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }
        });
    </script>
</body>

</html>
