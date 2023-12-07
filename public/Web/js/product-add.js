$(document).ready(function () {

    function previewImage(input) {
        var fileInput = $(input);
        var file = fileInput[0].files[0];
        var imagePreview = $('#imagePreview');

        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
                imagePreview.show();
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview.attr('src', '#');
            imagePreview.hide();
        }
    }

    $('#image').change(function () {
        previewImage(this);
    });

    $("#addProductForm").submit(function (event) {
        event.preventDefault();

        var formData = {
            product_name: $("#product_name").val(),
            export_price: $("#export_price").val(),
            image: $("#image")[0].files[0],
            description: $("#description").val(),
        };

        var form = new FormData();
        for (var key in formData) {
            form.append(key, formData[key]);
        }

        for (var pair of form.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/v1/product/add",
            data: form,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log("Product updated successfully:", data);
                createAndShowModal('Thành công', 'Thêm sản phẩm thành công!', true);
            },
            error: function (error) {
                createAndShowModal('Thất bại', 'Thêm sản phẩm thất bại. Vui lòng thử lại', false);
            },
        });

    });


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

    $(document).on('hidden.bs.modal', '#customModal', function () {
        location.reload();
    });

});
