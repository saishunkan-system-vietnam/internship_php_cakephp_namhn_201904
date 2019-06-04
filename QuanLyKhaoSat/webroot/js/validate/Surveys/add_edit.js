$(document).ready(function () {
    jQuery.validator.addMethod("img", function (value, element) {
        // Kiểm tra định dạng của chuỗi nhập vào bằng biểu thức chính quy
        return this.optional(element) || /\.(jpg|jpeg|png|gif|JPG|PNG|JPEG|GIF)$/.test(value);
    }, 'File bạn tải lên không phải là ảnh');
    $("#Surveys").validate({
        rules: {
            name: {
                required: true,
                maxlength: 30,
                minlength: 5,
            },
            img: {
                img : true,
            }
        },
        messages: {
            name: {
                required : "Bạn vui lòng nhập tên Khảo Sát ",
                maxlength : "Khảo Sát phải có độ dài tối đa 30 ký tự",
                minlength: "Khảo Sát phải lớn hơn 5 ký tự",
            },
            img: {
                img : "File bạn tải lên không phải là ảnh",
            }
        }
    });
});