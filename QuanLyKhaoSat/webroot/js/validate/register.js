$(document).ready(function () {
    $("#formRegisters").validate({
        rules: {
            email: "required",
            password1: "required",
            password2: "required",
            address: "required",
            phone: "required",
            birth: "required",
            secret_a:"required",
            fullname: {
                required: true,
            }
        },
        messages: {
            email: "Bạn quên nhập email rồi ^^!",
            password1: "Bạn quên nhập password rồi ^^!",
            password2: "Bạn quên nhập password rồi ^^!",
            address: "Bạn quên nhập địa chỉ kìa ^^!",
            phone: "Hãy cho tôi biết số điện thoại của bạn ^^!",
            birth: "Ngày tháng năm sinh của bạn là chi ? ^^",
            secret_a: "Hãy nhập câu trả lời của bạn ^^",
            fullname: {
                required: "Bạn ơi Nhập họ tên đầy đủ của mình đi",
            }
        }
    });
});