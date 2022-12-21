<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php echo (!empty($page_title)) ? $page_title : "Trang Chủ" ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo _WEB_ROOT ?>/public/assets/user/images/icon.png">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/user/css/styles.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
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
    <?php
    if (empty($sub_content)) {
        $this->render($content);
    } else {
        $this->render($content, $sub_content);
    }
    $this->render('blocks/user/footer');
    ?>
</body>

</html>