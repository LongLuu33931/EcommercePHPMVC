<!-- action="<?php echo _WEB_ROOT ?>/account/register" method="POST" -->
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="<?php echo _WEB_ROOT ?>/public/assets/user/images/anh1.png" width="100%">
            </div>

            <div class="col-2">
                <div class="form-container" style="height: 600px;">
                    <div class="form-btn">
                        <span onclick="login()">Đăng nhập</span>
                        <span onclick="register()">Đăng ký</span>
                        <hr id="Indicator">
                    </div>
                    <form id="LoginForm" action="<?php echo _WEB_ROOT ?>/account/login" method="POST">
                        <?php
                        if (isset($_SESSION["message_checkLogin"])) {
                        ?>
                            <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_checkLogin"] ?></div>
                        <?php } ?>
                        <input name="username" type="text" placeholder="Tên đăng nhập">
                        <?php
                        if (isset($_SESSION["message_usernameLogin"])) {
                        ?>
                            <div style="color: red;"><?php echo $_SESSION["message_usernameLogin"] ?></div>
                        <?php } ?>
                        <input name="password" type="password" placeholder="Mật khẩu">
                        <?php
                        if (isset($_SESSION["message_passwordLogin"])) {
                        ?>
                            <div style="color: red;"><?php echo $_SESSION["message_passwordLogin"] ?></div>
                        <?php } ?>
                        <button type="submit" class="btn">Đăng nhập</button>
                    </form>

                    <form id="RegForm" action="<?php echo _WEB_ROOT ?>/account/register" method="POST">
                        <?php
                        if (isset($_SESSION["message_check"])) {
                        ?>
                            <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_check"] ?></div>
                        <?php } ?>
                        <input name="username" type="text" placeholder="Tên đăng nhập">
                        <?php
                        if (isset($_SESSION["message_username"])) {
                        ?>
                            <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_username"] ?></div>
                        <?php } ?>
                        <input name="password" type="password" placeholder="Mật khẩu">
                        <?php
                        if (isset($_SESSION["message_password"])) {
                        ?>
                            <div style="color: red; padding-bottom: 16px;"><?php echo $_SESSION["message_password"] ?></div>
                        <?php } ?>
                        <input name="confirmPassword" type="password" placeholder="Nhập lại mật khẩu">
                        <button type="submit" class="btn">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>