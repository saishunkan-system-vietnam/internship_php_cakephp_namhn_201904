$(document).ready(function () {
    $("#formQuestions").validate({
        rules: {
            answers: "required",
            name: {
                required: true,
                minlength: 10,
            }
        },
        messages: {
            answers: "Hãy cho tôi biết các đáp án bạn đưa ra :P",
            name: {
                required: "Hãy cho tôi biết tên câu hỏi bạn muốn ^^",
                minlength: "Câu hỏi hơi ngắn thì phải :)) ?"
            }
        }
    });
});