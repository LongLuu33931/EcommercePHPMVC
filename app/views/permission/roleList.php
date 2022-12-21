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
                            <th data-sortable='false' style="width:70%">ID</th>
                            <th data-sortable='false' style="width:15%">Vai trò</th>
                            <th data-sortable='false' style="width:15%"><a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i data-feather="user-plus" class="material-icons"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($role_list as $item) : ?>
                            <tr>
                                <td>
                                    <?= $item['id'] ?>
                                </td>
                                <td>
                                    <?= $item['role_name']
                                    ?>
                                </td>
                                <td>
                                    <a class='btn-danger' style="border-radius: 0.267rem; padding:0.467rem 0.5rem" name='delete' href='<?php echo _WEB_ROOT ?>/permission/deleteRole/<?= $item['id'] ?>'>Xóa</a>
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
            <form action="<?php echo _WEB_ROOT ?>/permission/insertRole" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm vai trò</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Vai trò</label>
                        <input type="text" name="rolename" class="form-control">
                        <?php
                        if (isset($_SESSION['check_role_name'])) {
                        ?>
                            <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION['check_role_name'] ?></div>
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