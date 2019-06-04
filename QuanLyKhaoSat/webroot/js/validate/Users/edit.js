$(document).ready(function () {
    $("#pass2").hide();
    $("#show").hide();
    $("#pass1").keyup(function () {
        if ($("#pass1").val() != '') {
            $("#pass2").show();
        } else {
            $("#pass2").hide();
        }
    });
    if ($("#pass1").val() != '') {
        $("#pass2").show();
    }
    jQuery.validator.addMethod("tel", function (value, element) {
        // Kiểm tra định dạng của chuỗi nhập vào bằng biểu thức chính quy
        return this.optional(element) || /^[0-9]/.test(value);
    }, 'Số điện thoại nhập chưa chính xác');
    jQuery.validator.addMethod("pass", function (value, element) {
        // Kiểm tra định dạng của chuỗi nhập vào bằng biểu thức chính quy
        return this.optional(element) || /^(?=.{5,})(?=.*[a-z]+)(?=.*\d+)(?=.*[A-Z]+)(?=.*[^\w])[ -~]+$/.test(value);
    }, 'Số điện thoại nhập chưa chính xác');
    $("#Users").validate({
        rules: {
            email: {
                required: true,
                maxlength: 20,
            },
            password1: {
                pass : true,
            },
            password2: "required",
            address: "required",
            phone: {
                required: true,
                tel: true,
                number: true,
                minlength: 8,
                maxlength: 15,
            },
            birth: "required",
            secret_q: "required",
            secret_a: "required",
            fullname: {
                required: true,
                minlength: 5,
                maxlength: 20,
            }
        },
        messages: {
            email: {
                required : "Bạn vui lòng nhập Email ",
                maxlength : "Email độ dài tối đa 20 ký tự",
            },
            password1: {
                pass: "Mật khẩu yêu cầu : 1 chữ số + 1 chữ viết hoa + 1 chữ viết thường + 1 ký tự đặc biệt"
            },
            password2: "Bạn quên nhập lại password rồi ^^!",
            address: "Bạn quên nhập địa chỉ kìa ^^!",
            phone: {
                required: "Hãy cho tôi biết số điện thoại của bạn ^^!",
                tel: "Số điện thoại nhập chưa chính xác",
                number: "Số điện thoại nhập chưa chính xác",
                minlength: "Số điện thoại cần ít nhất 8 số",
                maxlength: "Số điện thoại nhiều nhất 15 số",
            },
            birth: "Ngày tháng năm sinh của bạn là chi ? ^^",
            secret_q: "Hãy chọn câu hỏi để tăng tính bảo mật",
            secret_a: "Bạn quên trả lời câu hỏi kìa ^^",
            fullname: {
                required: "Bạn ơi Nhập họ tên đầy đủ của mình đi",
                minlength: "Họ tên của bạn có vẻ hơi ngắn rồi ^^! ?",
                maxlength: "Họ tên phải nhỏ hơn 20 ký tự",
            }
        }
    });
});