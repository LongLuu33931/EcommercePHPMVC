<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>

        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Phân Quyền</h4>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th data-sortable='false' style="width:70%">Tên đăng nhập</th>
                            <th data-sortable='false' style="width:15%">Vai trò</th>
                            <th data-sortable='false' style="width:15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1 ?>
                        <?php foreach ($list_seller as $item) : ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td>
                                    <?= $item['username'] ?>
                                </td>
                                <td>
                                    <?= $item['role_name']
                                    ?>
                                </td>
                                <td style="align-items: center;">
                                    <a class='btn-primary' style="border-radius: 0.267rem; padding:0.467rem 0.5rem" href='<?php echo _WEB_ROOT ?>/permission/productListBySeller/<?= $item['user_id'] ?>'>Danh sách sản phẩm</a>
                                </td>
                            </tr>
                            <?php $count++ ?>
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
            <form action="<?php echo _WEB_ROOT ?>/permission/insertUser" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm người dùng</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <?php
                    if (isset($_SESSION["message_check"])) {
                    ?>
                        <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_check"] ?></div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" class="form-control">
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