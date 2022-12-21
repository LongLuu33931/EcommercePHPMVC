<div class="main-content container-fluid">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Sản Phẩm</h4>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="false">Mã sản phẩm</th>
                            <th data-sortable="false">Tên sản phẩm</th>
                            <th data-sortable="false">Giá</th>
                            <th data-sortable="false">Ngày tạo</th>
                            <th data-sortable="false">Ngày cập nhật</th>
                            <th data-sortable="false">Trạng thái</th>
                            <th data-sortable="false"><a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Thêm sản phẩm</span></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product_list as $item) : ?>
                            <?php $amount = number_format($item['price'], 0, ",", "."); ?>
                            <?php $status = ($item['approved'] == 1) ? "Hiện" : "Ẩn" ?>
                            <tr>
                                <td style="text-align: center;">
                                    <?= $item['product_id'] ?>
                                </td>
                                <td>
                                    <?= $item['product_name'] ?>
                                </td>
                                <td>
                                    <?= $amount ?>
                                </td>
                                <td>
                                    <?= $item['create_date'] ?>
                                </td>
                                <td>
                                    <?= $item['update_date'] ?>
                                </td>
                                <td style="text-align: center;">
                                    <?= $status ?>
                                </td>
                                <td style="text-align: center;">
                                    <a class='btn-primary' style="border-radius: 0.267rem; padding:0.467rem 0.5rem" href='<?php echo _WEB_ROOT ?>/product/detailProduct/<?= $item['product_id'] ?>'>Chi tiết</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </section>
</div>
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo _WEB_ROOT ?>/product/addProduct" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <?php
                    if (isset($_SESSION["message_summary"])) {
                    ?>
                        <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_summary"] ?></div>
                    <?php } ?>
                    <?php
                    if (isset($_SESSION["message"])) {
                    ?>
                        <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message"] ?></div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="product_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Chi tiết</label>
                        <input class="form-control" name="detail"></input>
                    </div>
                    <div class="form-group">
                        <label>Giá</label>
                        <input class="form-control" name="price"></input>
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input class="form-control" name="inventory" min="1" type="number"></input>
                    </div>
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select class="form-select" name="category" id="">
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input class="form-control" type="file" name="my_file" id="fileToUpload" accept="image/*">
                        <?php
                        if (isset($_SESSION['img'])) {
                        ?>
                            <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION['img'] ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-default" value="Nhập lại">
                    <input type="submit" name="addProduct" class="btn btn-success" value="Thêm">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
</script>