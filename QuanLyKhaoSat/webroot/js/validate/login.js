$(document).ready(function () {
    $("#formLogin").validate({
        rules: {
            email: "required",
            password: "required",
        },
        messages: {
            email: "Bạn quên nhập email rồi ^^!",
            password: "Bạn quên nhập password rồi ^^!",
        }
    });
});