<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>

    <link rel="stylesheet" href="{{ asset('Web/vendor/css/bootstrap.min.css') }}">

</head>
<body>
<div class="container mt-5">

    @include('navbar')

    <div class="d-flex justify-content-between align-items-center my-3">
        <h2 class="my-0">Danh sách sản phẩm</h2>
        <div class="d-flex align-items-center">
            <select id="productsPerPage" class="form-control mr-3" onchange="changeProductsPerPage()">
                <option value="2">2</option>
                <option value="5">5</option>
                <option value="7">7</option>
            </select>
            <a class="btn btn-primary" href="{{ url('/product-add') }}">Thêm sản phẩm</a>
        </div>
    </div>
    
    <div id="productRangeInfo" class="mb-3"></div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Mô tả</th>
                    <th>Giá bán</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="productTableBody">
               
            </tbody>
        </table>
    </div>
    <ul id="paginationContainer" class="pagination d-flex justify-content-center"></ul>
</div>

<script src="{{ asset('Web/vendor/js/jquery.js') }}"></script>
<script src="{{ asset('Web/vendor/js/popper.min.js') }}"></script>
<script src="{{ asset('Web/vendor/js/bootstrap.min.js') }}"></script>

<script>
    var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
    var baseUrl = "{{ asset('') }}";
</script>
<script src="{{ asset('Web/js/product-list.js') }}"></script>

</body>
</html>
