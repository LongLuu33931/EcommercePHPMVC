<div class="main-content container-fluid">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Sản Phẩm của <?= $user['username'] ?></h4>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="false" style="width:9%">Mã sản phẩm</th>
                            <th data-sortable="false">Tên sản phẩm</th>
                            <th data-sortable="false" style="width:9%">Giá</th>
                            <th data-sortable="false" style="width:9%">Ngày tạo</th>
                            <th data-sortable="false" style="width:9%">Ngày cập nhật</th>
                            <th data-sortable="false" style="width:9%">Trạng thái</th>
                            <th data-sortable="false"><a style="background-color: transparent; border-color: transparent;" href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Thêm sản phẩm</span></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product_list as $item) : ?>
                            <?php $amount = number_format($item['price'], 0, ",", "."); ?>
                            <?php $status = ($item['approved'] == 1) ? "Hiện" : "Ẩn" ?>
                            <tr>
                                <td>
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
                                <td>
                                    <?= $status ?>
                                </td>
                                <td>
                                    <a class='btn-primary' style="border-radius: 0.267rem; padding:0.467rem 0.5rem" href='<?php echo _WEB_ROOT ?>/permission/detailProduct/<?= $item['product_id'] ?>'>Chi tiết</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </section>
</div>