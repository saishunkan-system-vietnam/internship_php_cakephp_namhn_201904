<fieldset class="col-md-6 col-md-offset-3">
    <?php if (isset($error->name)) { ?>
        <div class="alert alert-danger">
            Questions đã tồn tại, xin vui lòng nhập Questions khác !
        </div>
    <?php } ?>
    <legend>
        EDIT Questions
    </legend>
    <form action="<?= URL ?>questions/edit/<?php echo $data->id ?>" id="formQuestions" method="post" enctype="multipart/form-data">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Type Question</th>
                <td>
                    <label>
                        <input name="typeQ" type="radio" value="Text" <?php if ($data->type_question == 'Text') {echo 'checked';}?> />
                        <span>Text</span>
                    </label>
                    <label>
                        <input name="typeQ" type="radio" value="Images" <?php if ($data->type_question == 'Images') {echo 'checked';}?>/>
                        <span>Images</span>
                    </label>
                </td>
            </tr>
            <tr id="file">
                <th>File Images</th>
                <td><input type="file" name="fileImg"></td>
            </tr>
            <tr id="name">
                <th>Name</th>
                <td><input value="<?php echo isset($result[0]) ? $result[0] : $data->name ?>"
                           type="text" name="name" class="form-control"></td>
            </tr>
            <tr>
                <th>Khảo Sát</th>
                <th>
                    <select class="form-control" name="survey_id">
                        <option value="<?php echo $dataS->id ?>"><?php echo $dataS->name ?></option>
                    </select>
                </th>
            </tr>
            <tr>
                <th>Type_answer</th>
                <td>
                    <select class="form-control" name="type_answer" id="type_answer">
                        <option value="<?php echo $data->type_answer ?>"><?php echo isset($result[2]) ? $result[2] : $data->type_answer ?></option>
                        <option value="Radio">Radio</option>
                        <option value="Checkbox">Checkbox</option>
                        <option value="Text">Text</option>
                        <option value="TextArea">TextArea</option>
                        <option value="Select">Select</option>
                    </select>
                </td>
            </tr>
            <tr id="answer">
                <th>Answers</th>
                <td><input value="<?php echo isset($result[3]) ? $result[3] : $data->answers ?>"
                           type="text" name="answers" class="form-control"></td>
            </tr>
            <tr>
                <th>Trạng Thái</th>
                <td style="text-align: left">
                    <label>
                        <input name="status" type="radio" <?php if ($data->status == 'yes'){echo 'checked';}?> value="yes"/>
                        <span>Bắt Buộc Trả Lời</span>
                    </label>
                    <label>
                        <input name="status" type="radio" <?php if ($data->status == 'no'){echo 'checked';}?> value="no"/>
                        <span>Không Bắt Buộc</span>
                    </label>
                </td>
            </tr>
            <tr id="submit">
                <th></th>
                <td>
                    <button class="btn btn-primary" type="submit"><i class="far fa-thumbs-up"></i> Submit</button>
                    <button class="btn btn-danger" type="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/questions'); ?>
<!--     Sử Lý phần Type Question lấy giá trị Radio Button     -->
<script>
    $(document).ready(function(){
        $("#file").hide();
        $("#name").hide();
        $("input[type='radio']").click(function(){
            var typeQ = $("input[name='typeQ']:checked").val();
            if(typeQ == "Text"){
                $("#file").hide();
                $("#name").show();
            }if(typeQ == "Images"){
                $("#file").show();
                $("#name").hide();

            }
        });

    });
</script>
<?php if ($data->type_answer == "Text" || $data->type_answer == "TextArea") { ?>
    <script>
        $(document).ready(function () {
            $("#answer").hide();
        });
    </script>
<?php } ?>
<?php if ($data->type_question == "Text") { ?>
    <script>
        $(document).ready(function () {
            $("#name").show();
        });
    </script>
<?php } ?>
<?php if ($data->type_question == "Images") { ?>
    <script>
        $(document).ready(function () {
            $("#file").show();
        });
    </script>
<?php } ?>
<script>
    $('select').on('change', function () {
        var x = $(this).val();
        if (x == 'Text' || x == 'TextArea') {
            $("#answer").hide();
        }
        if (x == 'Radio' || x == 'Checkbox' || x == 'Select') {
            $("#answer").show();
        }
    });
</script>
