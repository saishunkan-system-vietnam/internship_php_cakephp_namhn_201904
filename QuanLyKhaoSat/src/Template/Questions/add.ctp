<fieldset class="col-md-6 col-md-offset-3">
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
        <table class="table table-hover table-bordered" id="formQuestions">
            <tr>
                <th>Kiểu Câu Hỏi</th>
                <td style="text-align: left">
                    <label>
                        <input name="typeQ" type="radio" checked value="Text"/>
                        <span>Text</span>
                    </label>
                    <label>
                        <input name="typeQ" type="radio" value="Images"/>
                        <span>Images</span>
                    </label>
                </td>
            </tr>
            <tr id="file">
                <th>File Ảnh</th>
                <td><input type="file" name="fileImg" required></td>
            </tr>
            <tr id="name">
                <th>Tên Câu Hỏi</th>
                <td>
                    <input placeholder="Nhập tên khảo sát"
                            value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                           type="text" name="name" class="form-control">
                </td>
            </tr>
            <tr>
                <th>Kiểu Đáp Án</th>
                <td>
                    <select class="form-control" name="type_answer" id="type_answer">
                        <option value="Radio">Radio</option>
                        <option value="Checkbox">Checkbox</option>
                        <option value="Text">Text</option>
                        <option value="TextArea">TextArea</option>
                        <option value="Select">Select</option>
                        <option value="Images">Images</option>
                    </select>
                </td>
            </tr>
            <tr id="answer">
                <th>Đáp Án</th>
                <td><input placeholder="Nhập đáp án được cách nhau bởi dấu ',' "
                            value="<?php echo isset($result[3]) ? $result[3] : '' ?>"
                           type="text" name="answers" class="form-control"></td>
            </tr>
            <tr>
                <th>Trạng Thái</th>
                <td style="text-align: left">
                    <label>
                        <input name="status" type="radio" checked value="yes"/>
                        <span>Bắt Buộc Trả Lời</span>
                    </label>
                    <label>
                        <input name="status" type="radio" value="no"/>
                        <span>Không Bắt Buộc</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
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
<!--     Sử Lý phần Type Answer lấy giá trị Select     -->
<script>
    $(document).ready(function () {
        $("#file").hide();
        $('select').on('change', function () {
            // alert(this.value);
            var x = $(this).val();
            if (x == 'Text' || x == 'TextArea' || x == 'Images') {
                $("#answer").hide();
            }
            if (x == 'Radio' || x == 'Checkbox' || x == 'Select') {
                $("#answer").show();
            }
        });
    });
</script>
