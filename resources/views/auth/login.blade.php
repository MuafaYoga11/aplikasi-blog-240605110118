<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .login-header {
            text-align: center;
            margin-bottom: 24px;
        }
        .login-header h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }
        .login-header p {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }
        .form-control:focus {
            border-color: #3b5bdb;
            box-shadow: 0 0 0 0.25rem rgba(59, 91, 219, 0.25);
        }
        .btn-login {
            background-color: #3b5bdb;
            color: white;
            border: none;
            font-weight: 600;
            padding: 10px;
        }
        .btn-login:hover {
            background-color: #324fb6;
            color: white;
        }
    </style>
</head>
<body>

    <div class="card login-card p-4">
        <div class="login-header">
            <h4>Aplikasi Blog</h4>
            <p>Masukkan kredensial untuk melanjutkan</p>
        </div>

        @if($errors->has('loginError'))
            <div class="alert alert-danger py-2 px-3 small text-center">
                {{ $errors->first('loginError') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-3">
                <label for="user_name" class="form-label small fw-bold">Username</label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="{{ old('user_name') }}" required autofocus>
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label small fw-bold">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
    </div>

</body>
</html>
