<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="<?= _WEB_ROOT . '/home/index' ?>"><img src="<?php echo _WEB_ROOT ?>/public/assets/user/images/logo.png" alt="logo.png" width="125px"></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <b class="item">
                        <li><a href="<?= _WEB_ROOT . '/home/men' ?>">Nam</a></li>
                        <li><a href="<?= _WEB_ROOT . '/home/woman' ?>">Nữ</a></li>
                        <?php
                        if (isset($_SESSION['username'])) {
                        ?>
                            <li><a href="<?= _WEB_ROOT . '/home/orderlist' ?>">Đơn Hàng</a></li>

                            <li>
                                <div>
                                    <div>Xin chào <?php echo $_SESSION['username'] ?></div>
                                    <a style="color: red;" href="<?= _WEB_ROOT . "/account/logout" ?>">Đăng xuất</a>
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
            <a href="<?= _WEB_ROOT . '/home/cart/' ?>"><img src="<?php echo _WEB_ROOT ?>/public/assets/user/images/cart.png" alt="cart.png" width="30px" height="30px">
                <img src="<?php echo _WEB_ROOT ?>/public/assets/user/images/menu.png" class="menu-icon" onclick="menutoggle()">
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
        <div class="row">
            <div class="col-2">
                <h1>Chúng tôi luôn mang đến cho bạn<br> những mẫu đồng hồ tốt nhất</h1>
                <p>Đến với WS25 bạn sẽ luôn tìm được cho mình những mẫu đồng hồ <br>phù hợp với tất cả các nhu cầu và giá thành
                    từ bình dân đến cao cấp
                </p>
                <a href="#" class="btn">Khám phá ngay &#8594;</a>
            </div>
            <div class="col-2">
                <img src="<?php echo _WEB_ROOT ?>/public/assets/user/images/anh1.png" alt="Images.png">
            </div>
        </div>
    </div>
</div>