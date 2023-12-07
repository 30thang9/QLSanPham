<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="{{ asset('Web/vendor/css/bootstrap.min.css') }}">

</head>
<body>
    <div class="container mt-4">
        <!-- Navbar -->
        @include('navbar')

        <!-- Content -->
        <div class="jumbotron mt-4">
            <h1 class="display-4">Chào mừng đến với website quản lý sản phẩm!</h1>
            <p class="lead">.</p>
        </div>
    </div>

    <script src="{{ asset('Web/vendor/js/jquery.js') }}"></script>
    <script src="{{ asset('Web/vendor/js/popper.min.js') }}"></script>
    <script src="{{ asset('Web/vendor/js/bootstrap.min.js') }}"></script>
    
</body>
</html>
