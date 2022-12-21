<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php echo (!empty($page_title)) ? $page_title : "WS25" ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo _WEB_ROOT ?>/public/assets/user/images/icon.png">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/user/css/styles.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <?php
    $this->render('blocks/user/cart_header');
    if (empty($sub_content)) {
        $this->render($content);
    } else {
        $this->render($content, $sub_content);
    }
    $this->render('blocks/user/footer');
    ?>
</body>
<script src="<?php echo _WEB_ROOT ?>/public/assets/user/js/main.js"></script>

</html>