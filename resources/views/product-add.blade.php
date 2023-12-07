<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="{{ asset('Web/vendor/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container mt-5">
        @include('navbar')

        <div class="my-3">
            <h2 class="my-0">Thêm sản phẩm</h2>
        </div>

        <form id="addProductForm" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="product_name">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="export_price">Giá bán:</label>
                    <input type="number" class="form-control" id="export_price" name="export_price" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="description">Mô tả sản phẩm:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="image">Ảnh sản phẩm:</label>
                    <div class="">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                            <label class="custom-file-label" for="image">Chọn ảnh</label>
                        </div>
                        <div class="d-flex justify-content-start">
                            <img id="imagePreview" src="#" alt="Preview" class="img-fluid mt-2" style="max-width: 280px; display: none;">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-bottom: 5rem;">Thêm sản phẩm</button>
        </form>
        
    </div>

    <script src="{{ asset('Web/vendor/js/jquery.js') }}"></script>
    <script src="{{ asset('Web/vendor/js/popper.min.js') }}"></script>
    <script src="{{ asset('Web/vendor/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Web/js/product-add.js') }}"></script>
</body>
</html>
