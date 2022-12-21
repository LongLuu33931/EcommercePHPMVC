<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WS25 - Sale</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/css/app.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img style="width: 100px; height: 100px" src="<?php echo _WEB_ROOT ?>/public/assets/user/images/logo.png" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item">
                            <a href="<?= _WEB_ROOT . '/product/index' ?>" class='sidebar-link'>
                                <span>Quản Lý Sản Phẩm</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= _WEB_ROOT . '/product/order' ?>" class='sidebar-link'>
                                <span>Quản Lý Đơn Hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-none d-md-block d-lg-inline-block">Hi, <?php echo $_SESSION['username'] ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?= _WEB_ROOT . '/account/logout' ?>"><i data-feather="log-out"></i> Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <?php
            if (empty($sub_content)) {
                $this->render($content);
            } else {
                $this->render($content, $sub_content);
            }
            ?>
        </div>
    </div>
    <script src="http://localhost//mvcproject/public/assets/client/js/feather-icons/feather.min.js"></script>
    <script src="http://localhost//mvcproject/public/assets/client/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="http://localhost//mvcproject/public/assets/client/js/app.js"></script>

    <script src="http://localhost//mvcproject/public/assets/client/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="http://localhost//mvcproject/public/assets/client/js/vendors.js"></script>

    <script src="http://localhost//mvcproject/public/assets/client/js/main.js"></script>
</body>

</html>