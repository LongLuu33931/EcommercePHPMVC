<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php echo (!empty($page_title)) ? $page_title : "Trang Chủ" ?></title>
    <link rel="shortcut icon" type="image/png" href="Images/icon.png">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/user/css/styles.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/user/css/login.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    if (empty($sub_content)) {
        $this->render($content);
    } else {
        $this->render($content, $sub_content);
    }
    $this->render('blocks/user/footer');
    ?>
</body>
<script>
    var LoginForm = document.getElementById("LoginForm");
    var RegForm = document.getElementById("RegForm");
    var Indicator = document.getElementById("Indicator");

    function login() {

        RegForm.style.transform = "translateX(300px)";
        LoginForm.style.transform = "translateX(300px)";
        Indicator.style.transform = "translateX(0px)";
    }

    function register() {

        RegForm.style.transform = "translateX(0px)";
        LoginForm.style.transform = "translateX(0px)";
        Indicator.style.transform = "translateX(100px)";
    }
</script>

</html>