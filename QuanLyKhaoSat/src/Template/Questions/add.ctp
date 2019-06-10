<style>
    tr {
        height: 60px;
    }

    th {
        text-align: left;
        font-size: 20px;
        width: 30%;
    }

    td {
        font-size: 20px;
        width: 70%;
    }

    .error {
        font-size: 20px;
        color: red;
    }
</style>
<?php if (empty($dataId)) { ?>
    <a href="<?= URL ?>surveys">
        <h1><u style="color: red">Đường Link Này Không Tồn Tại</u></h1>
    </a>
<?php } else { ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <fieldset class="col-md-8 col-md-offset-2">
        <?php if (isset($error->name)) { ?>
            <div class="alert alert-danger">
                Questions đã tồn tại, xin vui lòng nhập Questions khác !
            </div>
        <?php } ?>
        <legend>
            ADD Questions <?php echo $dataId->name; ?>
        </legend>
        <form action="<?= URL ?>questions/add/<?php echo isset($id) ? $id : '' ?>" id="formQuestions" method="post"
              enctype="multipart/form-data">
            <table class="table table-bordered" id="formQuestions">
                <tr>
                    <th>Kiểu Câu Hỏi <span style="color: red">( * )</span></th>
                    <td style="text-align: left">
                        <label>
                            <input name="typeQ" type="radio" checked value="Text"/>
                            <span style="font-size: 20px;color: black;font-weight: bold">Text</span>
                        </label><br>
                        <label>
                            <input name="typeQ" type="radio" value="Images"/>
                            <span style="font-size: 20px;color: black;font-weight: bold">Images</span>
                        </label>
                    </td>
                </tr>
                <tr id="file">
                    <th>File Ảnh <span style="color: red">( * )</span></th>
                    <td>
                        <input type="file" accept="image/*" name="fileImg" id="i_file" style="display: none">
                        <button class="fileImage" type="button"
                                style="background-color: darkred;border-radius: 7px; ;color: white;height: 40px;width: 110px;">
                            Chọn Ảnh
                        </button>
                        <input type="text" disabled name="img" id="image" value=""
                               style="border-radius: 7px;border: none;height: 38px;width: 60%;font-size: 25px;font-family: 'Times New Roman';background-color: white;color: red;font-weight: bold">
                    </td>
                    <script>
                        $(document).on("click", ".fileImage", function () {
                            $("#i_file").trigger("click");
                        });
                        $('input[type="file"]').change(function (e) {
                            if (e.target.files[0] != undefined) {
                                let fileName = e.target.files[0].name;
                                $('#image').val(fileName);
                            }
                        });
                    </script>
                </tr>
                <tr id="name">
                    <th>Tên Câu Hỏi <span style="color: red">( * )</span></th>
                    <td>
                        <input placeholder="Nhập tên khảo sát" style="font-size: 20px;color: black;font-weight: bold"
                               value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                               type="text" name="name" class="form-control">
                    </td>
                </tr>
                <tr>
                    <th>Kiểu Đáp Án <span style="color: red">( * )</span></th>
                    <td>
                        <select style="font-size: 18px;color: black;font-weight: bold;height: 40px; "
                                class="form-control" name="type_answer"
                                id="type_answer">
                            <option value="Radio">Radio</option>
                            <option value="Checkbox">Checkbox</option>
                            <option value="Text">Text</option>
                            <option value="TextArea">TextArea</option>
                            <option value="Select">Select</option>
                            <option value="Images">Images</option>
                        </select>
                    </td>
                </tr>
                <tr id="typeText">
                    <th>Định Dạng Text <span style="color: red">( * )</span></th>
                    <td>
                        <label>
                            <input name="typeText" type="radio" checked value="text"/>
                            <span style="font-size: 20px;color: black;font-weight: bold">Text</span>
                        </label><br>
                        <label>
                            <input name="typeText" type="radio" value="date"/>
                            <span style="font-size: 20px;color: black;font-weight: bold">Date</span>
                        </label><br>
                        <label>
                            <input name="typeText" type="radio" value="number"/>
                            <span style="font-size: 20px;color: black;font-weight: bold">Number</span>
                        </label><br>
                        <label>
                            <input name="typeText" type="radio" value="tel"/>
                            <span style="font-size: 20px;color: black;font-weight: bold">Tel</span>
                        </label><br>
                        <label>
                            <input name="typeText" type="radio" value="email"/>
                            <span style="font-size: 20px;color: black;font-weight: bold">Email</span>
                        </label>
                    </td>
                </tr>
                <tr id="answer">
                    <th>Đáp Án <span style="color: red">( * )</span></th>
                    <td><input style="font-size: 20px;color: black;font-weight: bold"
                               placeholder="Nhập đáp án được cách nhau bởi dấu ',' "
                               value="<?php echo isset($result[3]) ? $result[3] : '' ?>"
                               type="text" name="answers" class="form-control"></td>
                </tr>
                <tr id="length">
                    <th>Validate</th>
                    <th>MinLength | <input type="number" value="<?php echo isset($result[5]) ? $result[5] : '' ?>"
                                           name="min" style="width: 150px;">&nbsp&nbsp
                        MaxLength | <input type="number" value="<?php echo isset($result[6]) ? $result[6] : '' ?>"
                                           name="max" style="width: 150px;"></th>
                </tr>
                <tr>
                    <th>Trạng Thái <span style="color: red">( * )</span></th>
                    <td style="text-align: left">
                        <label>
                            <input name="status" type="radio" checked value="yes"/>
                            <span style="font-size: 20px;color: black;font-weight: bold">Bắt Buộc Trả Lời</span>
                        </label><br>
                        <label>
                            <input name="status" type="radio" value="no"/>
                            <span style="font-size: 20px;color: black;font-weight: bold">Không Bắt Buộc</span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <button class="btn btn-primary" style="width: 120px;height: 45px" type="submit"><i
                                    class="far fa-thumbs-up"></i> Submit
                        </button>
                        <a href="<?= URL ?>surveys/view/<?= $dataId->id ?>">
                            <button class="btn btn-danger" style="width: 120px;height: 45px" type="button"><i
                                        class="fas fa-undo"></i> Back
                            </button>
                        </a>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <?php echo $this->Html->script('validate/questions'); ?>
    <!--     Sử Lý phần Type Question lấy giá trị Radio Button     -->
    <script>
        $(document).ready(function () {
            $("input[type='radio']").click(function () {
                var typeQ = $("input[name='typeQ']:checked").val();
                if (typeQ == "Text") {
                    $("#file").hide();
                    $("#name").show();
                }
                if (typeQ == "Images") {
                    $("#file").show();
                    $("#name").hide();
                }
            });

        });
    </script>
    <!--     Sử Lý phần Type Answer lấy giá trị Select     -->
    <script>
        $(document).ready(function () {
            $("#file").hide();
            $("#typeText").hide();
            $("#length").hide();
            $('select').on('change', function () {
                // alert(this.value);
                var x = $(this).val();
                if (x == 'TextArea') {
                    $("#answer").hide();
                    $("#typeText").hide();
                    $("#length").show();
                }
                if (x == 'Images') {
                    $("#answer").hide();
                    $("#typeText").hide();
                    $("#length").hide();
                }
                if (x == 'Radio' || x == 'Checkbox' || x == 'Select') {
                    $("#answer").show();
                    $("#typeText").hide();
                    $("#length").hide();
                }
                if (x == 'Text') {
                    $("#answer").hide();
                    $("#typeText").show();
                    $("#length").show();
                    $('#formQuestions input').on('change', function () {
                        var typeText = $('input[name=typeText]:checked', '#formQuestions').val();
                        if (typeText == 'date') {
                            $("#length").hide();
                        } else {
                            $("#length").show();
                        }
                    });
                }
            });
        });
    </script>
<?php } ?>