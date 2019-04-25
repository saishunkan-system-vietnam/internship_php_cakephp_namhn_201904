<fieldset class="col-lg-12" style="margin-top: 130px;">
    <legend>
        Khởi Tạo Khảo Sát
    </legend>
    <form>
        <table>
            <tr>
                <th>Danh mục khảo sát</th>
                <th>
                    <select class="form-control">
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th>Tên Khảo Sát</th>
                <th><input type="text" class="form-control"></th>
            </tr>
            <tr>
                <th>Trạng Thái Đăng Nhập</th>
                <th>
                    <label>
                        <input type="checkbox" checked="checked"/>
                        <span> </span>
                    </label>
                </th>
            </tr>
            <tr>
                <th>
                    <span>Ngày Bắt Đầu Khảo Sát :</span>
                </th>
                <th>
                    <input type="date">
                </th>
            </tr>
            <tr>
                <th>
                    Ngày Kết Thúc Khảo Sát :
                </th>
                <th>
                    <input type="date">
                </th>
            </tr>
            <tr>
                <th>
                    Số Khảo Sát Tối Đa :
                </th>
                <th>
                    <input type="name" class="form-control">
                </th>
            </tr>
            <tr>
                <th>
                    <button class="btn">
                        <a href="<?= SITE_URL ?>surveys/qadd">Thêm Câu Hỏi</a>
                    </button>
                </th>
            </tr>
        </table>
        <fieldset class="col-lg-10 col-lg-offset-1">
            <legend>
                Danh Sách Câu Hỏi
            </legend>
            <table>
                <tr>
                    <th>Câu Hỏi Số</th>
                    <td></td>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit"
                               name="submit"
                               value="Submit" class="btn">
                        <input type="reset"
                               value="Reset"
                               class="btn">
                    </td>
                </tr>
                </tr>
            </table>
        </fieldset>
    </form>
</fieldset>