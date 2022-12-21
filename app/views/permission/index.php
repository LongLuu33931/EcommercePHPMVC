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
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th data-sortable='false' style="width:70%">STT</th>
                            <th data-sortable='false' style="width:70%">Tên đăng nhập</th>
                            <th data-sortable='false' style="width:15%">Vai trò</th>
                            <th data-sortable='false' style="width:15%"><a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i data-feather="user-plus" class="material-icons"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1 ?>
                        <?php foreach ($user_list as $item) : ?>

                            <tr>
                                <td>
                                    <?= $count ?>
                                </td>
                                <td>
                                    <?= $item['username'] ?>
                                </td>
                                <td>
                                    <?= $item['role_name']
                                    ?>
                                </td>
                                <td>
                                    <a class='edit' href='<?php echo _WEB_ROOT ?>/permission/detailUser/<?= $item['username'] ?>'><i class='material-icons' data-toggle='tooltip' title='Detail' data-feather="info"></i></a>
                                    <a class='delete' name='delete' href='<?php echo _WEB_ROOT ?>/permission/deleteUser/<?= $item['username'] ?>'><i class='material-icons' data-toggle='tooltip' title='Delete' data-feather="delete"></i></a>
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