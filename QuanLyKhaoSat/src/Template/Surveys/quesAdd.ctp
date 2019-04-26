<?php echo $this->Html->css('haizzz'); ?>
<fieldset>
    <legend>Thêm câu hỏi mới</legend>
    <table>
        <tr>
            <th>Câu hỏi dạng Image</th>
            <td><input type="file"></td>
        </tr>
        <tr>
            <th>Câu hỏi dạng Text</th>
            <td><textarea></textarea></td>
        </tr>
        <tr>
            <th>Định dạng câu trả lời</th>
            <th>
                <select class="form-control">
                    <option value="">text</option>
                    <option value="">radio</option>
                    <option value="">checkbox</option>
                    <option value="">images</option>
                </select>
            </th>
        </tr>
        <tr>
            <th>Đáp án</th>
            <th>
                <textarea name="" id=""></textarea>
            </th>
        </tr>
        <tr>
            <th><a href=""><button>Đóng</button></a></th>
            <th><input type="submit" value="Lưu Lại"></th>
        </tr>
    </table>
</fieldset>