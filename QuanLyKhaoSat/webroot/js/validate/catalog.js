$(document).ready(function () {
    $("#Catalogs").validate({
        rules: {
            name: {
                required: true,
                maxlength: 40,
                minlength: 20,
            },
        },
        messages: {
            name: {
                required: "Bạn quên nhập tên Danh Mục rồi ^^!",
                maxlength: "Danh Mục Khảo Sát phải nhỏ hơn 40 ký tự",
                minlength: "Danh Mục Khảo Sát phải lớn hơn 20 ký tự",
            }
        }
    });
});