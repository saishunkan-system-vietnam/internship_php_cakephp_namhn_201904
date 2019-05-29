<style>
    button {
        background-color: #222222;
        color: white;
        height: 40px;
        width: 180px;
        border-radius: 5px;
        color: white;
    }
    button:hover {
        background-color: #0071BC;
    }
</style>
<fieldset class="col-lg-8 col-lg-offset-2" style="margin-top: 40px;">
    <legend style="height: 40px;width: 200px;line-height: 40px;font-weight: bold">[ Thông Báo ]</legend>
    <table class="table table-bordered">
        <tr>
            <th>Bạn Đã Hoàn Thành Khảo Sát <?= $data->name ;?></th>
        </tr>
        <tr>
            <th style="text-align: center;border-bottom: 1px solid #DDDDDD">Xin Trận Thành Cảm Ơn ^^!</th>
        </tr>
    </table>
    <div>
        <a style="margin-bottom: 10px;" class="pull-right" href="<?= URL ?>actions/catalog/<?= $dataCatalog->id ?>"><button>Quay Lại</button></a>
    </div>
</fieldset>