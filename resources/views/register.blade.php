<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>

    <link rel="stylesheet" href="{{ asset('Web/vendor/css/bootstrap.min.css') }}">

</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Đăng ký</span>
                    <a class="navbar-brand" href="{{ url('/') }}">Trang chủ</a>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="nam@gmail.com" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control"  placeholder="Mật khẩu ít nhất 3 ký tự" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"  placeholder="Mật khẩu xác nhận phải đúng với mật khẩu đã nhập" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </form>

                    <a class="btn btn-link mt-3" href="{{ route('login') }}">
                        Đã có tài khoản?Đăng nhập
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
