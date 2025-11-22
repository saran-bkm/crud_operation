<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
        }
        .login-wrapper {
            height: 100vh;
        }
        .login-card {
            border-radius: 12px;
            border: 1px solid #dedede;
        }
        .login-header {
            font-weight: 600;
            font-size: 22px;
        }
        .btn-login {
            font-weight: 600;
        }
        .form-control {
            height: 45px;
        }
        .input-group-text {
            background: #fff;
        }
    </style>
</head>

<body>

<div class="container login-wrapper d-flex justify-content-center align-items-center">

    <div class="col-md-4">

        <div class="card shadow-sm login-card p-3">

            <div class="card-body">

                <h4 class="text-center login-header mb-4">
                    <i class="fa fa-lock me-2"></i> Login
                </h4>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-key"></i>
                            </span>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger text-center py-2">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <button class="btn btn-primary w-100 btn-login mt-2">
                        Login
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>
