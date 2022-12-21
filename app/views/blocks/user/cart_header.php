<div class="container">
    <div class="navbar">
        <div class="logo">
            <a href="<?= _WEB_ROOT . '/home/index' ?>"><img src="<?php echo _WEB_ROOT ?>/public/assets/user/images/logo.png" alt="logo.png" width="125px"></a>
        </div>
        <nav>
            <ul id="MenuItems">
                <b class="item">
                    <li><a href="#">Nam</a></li>
                    <li><a href="#">Nữ</a></li>
                    <?php
                    if (isset($_SESSION['username'])) {
                    ?>
                        <li><a href="<?= _WEB_ROOT . '/home/orderlist' ?>">Đơn Hàng</a></li>
                        <li>
                            <div>
                                <div>Xin chào <?php echo $_SESSION['username'] ?></div>
                                <a style="color: red;" href="<?= _WEB_ROOT . '/account/logout' ?>">Đăng xuất</a>
                            </div>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li><a href="<?= _WEB_ROOT . '/account/index' ?>">Tài khoản</a></li>
                    <?php
                    }
                    ?>
                </b>
            </ul>
        </nav>
        <a href="<?= _WEB_ROOT . '/home/cart' ?>"><img src="<?php echo _WEB_ROOT ?>/public/assets/user/images/cart.png" width="30px" height="30px">
            <img src="Images/menu.png" alt="menu.png" class="menu-icon" onclick="menutoggle()">
            <?php
            if (isset($_SESSION['cartCount'])) {
            ?>
                <span class='badge badge-warning' id='lblCartCount'><?php echo $_SESSION['cartCount'] ?></span>
            <?php
            } else {
            ?>
                <span class='badge badge-warning' id='lblCartCount'>0</span>
            <?php
            }
            ?>
        </a>
    </div>
</div>