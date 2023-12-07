<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('Web/vendor/css/bootstrap.min.css') }}">

</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Đăng nhập</span>
                    <a class="navbar-brand" href="{{ url('/') }}">Trang chủ</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="nam@gmail.com" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu ít nhất 3 ký tự" required>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    </form>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    @endif

                    <a class="btn btn-link mt-3" href="{{ route('register') }}">
                        Chưa có tài khoản?Đăng ký
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('Web/vendor/js/jquery.js') }}"></script>
    <script src="{{ asset('Web/vendor/js/popper.min.js') }}"></script>
    <script src="{{ asset('Web/vendor/js/bootstrap.min.js') }}"></script>

</body>
</html>
