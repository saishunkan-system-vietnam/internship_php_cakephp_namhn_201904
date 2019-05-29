$(document).ready(function () {
    $("#formQuestions").validate({
        rules: {
            answers: "required",
            created: "required",
            name: {
                required: true,
                minlength: 10,
            }
        },
        messages: {
            answers: "Hãy cho tôi biết các đáp án bạn đưa ra :P",
            created: "Hãy cho tôi biết ngày khởi tạo Questions này",
            name: {
                required: "Hãy cho tôi biết họ tên của bạn ^^",
                minlength: "Câu hỏi hơi ngắn thì phải :)) ?"
            }
        }
    });
});