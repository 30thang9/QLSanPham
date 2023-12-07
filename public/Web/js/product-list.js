$(document).ready(function () {
    var $productsPerPageSelect = $('#productsPerPage');
    const defaultLimit = 2;

    const url = "/api/v1/product/list" + "?limit=" + defaultLimit;
    callApi(url);

    $productsPerPageSelect.on('change', function () {
        const selectedLimit = $productsPerPageSelect.val();
        const updatedUrl = "/api/v1/product/list" + "?limit=" + selectedLimit;
        callApi(updatedUrl);
    });

    $(document).on('hidden.bs.modal', '#customModal', function () {
        location.reload();
    });

});

function changePage(pageNumber) {
    const selectedLimit = $('#productsPerPage').val();
    const url = `/api/v1/product/list?page=${pageNumber}&limit=${selectedLimit}`;
    callApi(url);
}

function callApi(url) {
    $.ajax({
        url: url,
        type: "GET",
        contentType: 'application/json',
        success: function (data) {
            var dataResult = data.products;
            appendHtml(dataResult, data.pagination);
            createPaginationLinks(data.pagination);
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function appendHtml(products, pagination) {
    var $tableBody = $('#productTableBody');
    $tableBody.empty();

    if (products.length > 0) {
        products.forEach(function (product) {
            $tableBody.append(`
                <tr>
                    <td>${product.id}</td>
                    <td>${product.product_name}</td>
                    <td><img src="${baseUrl}Web/images/${product.image}" style="max-width: 50px;" class="img-fluid rounded-circle"></td>
                    <td>${product.description}</td>
                    <td>${isAuthenticated === false ? 'Liên hệ' : product.export_price}</td>
                    <td>${product.created_at === null ? '' : formatDate(product.created_at)}</td>
                    <td>${product.updated_at === null ? '' : formatDate(product.updated_at)}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="${'/product-edit/' + product.id}">Sửa</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.id})">Xóa</button>
                    </td>
                </tr>
            `);
        });

        var startProduct = (pagination.current_page - 1) * pagination.total_pages + 1;
        var endProduct = Math.min(startProduct + products.length - 1, pagination.total_products);
        $('#productRangeInfo').text(`Hiển thị ${startProduct}-${endProduct} trên tổng số ${pagination.total_products}  sản phẩm.`);

    } else {
        $tableBody.append(`
            <tr>
                <td colspan="8" class="text-center">Không có sản phẩm nào.</td>
            </tr>
        `);
    }
}

function deleteProduct(productId) {
    if (confirm('Bạn chắc chắn muốn xóa?')) {
        const url = `/api/v1/product/delete/${productId}`;
        $.ajax({
            url: url,
            type: "DELETE",
            contentType: 'application/json',
            success: function (data) {
                console.log("Product updated successfully:", data);
                createAndShowModal('Thành công', 'Xóa sản phẩm thành công!', true);
            },
            error: function (error) {
                createAndShowModal('Thất bại', 'Xóa sản phẩm thất bại. Vui lòng thử lại', false);
            },
        });
    }
}


function createAndShowModal(title, message, isSuccess) {
    $('#customModal').remove();

    var modalHtml = `
        <div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customModalLabel">${title}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>${message}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-${isSuccess ? 'success' : 'danger'}" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Append modal HTML to the body
    $('body').append(modalHtml);

    // Show the modal
    $('#customModal').modal('show');
}



function createPaginationLinks(pagination) {
    var $paginationContainer = $('#paginationContainer');
    $paginationContainer.empty();

    if (pagination.total_pages <= 1) {
        return;
    }

    var maxLinks = 3;
    var startPage = Math.max(pagination.current_page - Math.floor(maxLinks / 2), 1);
    var endPage = Math.min(startPage + maxLinks - 1, pagination.total_pages);

    if (pagination.current_page > 1) {
        $paginationContainer.append(`
            <li class="page-item">
                <a class="page-link" href="#" onclick="changePage(${pagination.current_page - 1})">Trước</a>
            </li>
        `);
    }

    for (var i = startPage; i <= endPage; i++) {
        $paginationContainer.append(`
            <li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
            </li>
        `);
    }

    if (pagination.current_page < pagination.total_pages) {
        $paginationContainer.append(`
            <li class="page-item">
                <a class="page-link" href="#" onclick="changePage(${pagination.current_page + 1})">Sau</a>
            </li>
        `);
    }
}



function formatDate(dateString) {
    if (!dateString) return '';

    const date = new Date(dateString);

    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();

    const formattedDate = `${day}/${month}/${year}`;

    return formattedDate;
}