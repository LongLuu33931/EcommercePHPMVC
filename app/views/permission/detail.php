    <!-- <div class="container">
        <div class="row">
            <form action="<?php echo _WEB_ROOT ?>/permission/editUserRole/<?= $user_info["username"] ?>" method="POST">
                <?php
                if (isset($_SESSION["message_roleValue"])) {
                ?>
                    <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_roleValue"] ?></div>
                <?php } ?>
                <?php
                if (isset($_SESSION["message_role"])) {
                ?>
                    <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_role"] ?></div>
                <?php } ?>
                <input type="hidden" name="username" class="form-control" value="<?= $user_info["username"] ?>" hidden>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tài khoản</label>
                        <input type="text" name="username" class="form-control" value="<?= $user_info["username"] ?>" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Mật khẩu</label>
                        <input type="text" name="password" class="form-control" value="<?= $user_info["password"] ?>" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Vai trò</label>
                        <input type="text" name="role" class="form-control" value="<?= $user_info["role"] ?>">
                    </div>
                </div>
                <div class="col-6">
                    <button type="submit" name="edit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div> -->

    <div class="main-content container-fluid">
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Chi tiết người dùng</h4>
                        </div>
                        <form action="<?php echo _WEB_ROOT ?>/permission/editUserRole/<?= $user_info["username"] ?>" method="POST">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        if (isset($_SESSION["message_roleValue"])) {
                                        ?>
                                            <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_roleValue"] ?></div>
                                        <?php } ?>
                                        <?php
                                        if (isset($_SESSION["message_role"])) {
                                        ?>
                                            <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_role"] ?></div>
                                        <?php } ?>
                                        <input type="hidden" name="username" class="form-control" value="<?= $user_info["username"] ?>" hidden>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Tài khoản</label>
                                                <input type="text" name="username" class="form-control" value="<?= $user_info["username"] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Mật khẩu</label>
                                                <input type="text" name="password" class="form-control" value="<?= $user_info["password"] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Vai trò</label>
                                                <input type="number" min="1" max="3" name="role" class="form-control" value="<?= $user_info["role_id"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" name="edit" class="btn btn-primary mr-4 mb-4">Sửa</button>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div>

        </section>
    </div>