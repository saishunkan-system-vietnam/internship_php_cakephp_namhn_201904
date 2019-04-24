<fieldset class="col-lg-12" style="margin-top: 150px;border: 2px solid black">
    <legend style="text-align: center;border: 2px solid #222222;border-radius: 7px;height: 40px;line-height: 40px;">Khởi Tạo Khảo Sát</legend>
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
                    <span>Yes</span>
                </label>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label>
                    <input type="checkbox" checked="checked"/>
                    <span>No</span>
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
                <a href="<?= SITE_URL?>surveys/add">
                    <button style="border: 1px solid black;border-radius: 5px;height: 35px;">
                        Thêm Câu Hỏi
                    </button>
                </a>
            </th>
        </tr>
    </table>
    <fieldset class="col-lg-10 col-lg-offset-1" style="border: 1px solid black;margin-top: 40px;">
        <legend style="text-align: center;border: 1px solid #222222;border-radius: 7px;height: 40px;line-height: 40px;">
            Danh Sách Câu Hỏi
        </legend>
        <table>
            <tr>
                <th></th>
                <td>
                    <input style="border: 1px solid black;border-radius: 5px"
                            type="submit" name="submit"
                           value="Lưu Lại" class="btn">
                    <input type="reset"
                           value="Đặt Lại"
                           class="btn">
                </td>
            </tr>
        </table>
    </fieldset>
</fieldset>