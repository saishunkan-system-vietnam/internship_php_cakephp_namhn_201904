$(document).ready(function () {
    $("#Groups").validate({
        rules: {
            name: {
                required: true,
                maxlength: 50,
                minlength: 5,
            },
        },
        messages: {
            name: {
                required: "Bạn quên nhập tên Danh Mục rồi ^^!",
                maxlength: "Danh Mục Khảo Sát phải nhỏ hơn 50 ký tự",
                minlength: "Danh Mục Khảo Sát phải lớn hơn 5 ký tự",
            }
        }
    });
});