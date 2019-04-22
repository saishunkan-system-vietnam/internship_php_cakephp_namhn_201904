$(document).ready(function () {
    $("#formUsers").validate({
        rules: {
            email: "required",
            password: "required",
            address: "required",
            phone: "required",
            birth: "required",
            fullname: {
                required: true,
                minlength: 10,
            }
        },
        messages: {
            email: "Vui lòng nhập email",
            password: "Vui lòng nhập password",
            address: "Vui lòng nhập địa chỉ của bạn",
            phone: "Vui lòng nhập số điện thoại của bạn",
            birth: "Vui lòng nhập ngày-tháng-năm sinh",
            fullname: {
                required: "Vui lòng nhập họ tên của bạn",
                minlength: "Họ tên ngắn vậy ?"
            }
        }
    });
});