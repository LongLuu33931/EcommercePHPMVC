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
    <?php
    $this->render('blocks/user/header');
    if (empty($sub_content)) {
        $this->render($content);
    } else {
        $this->render($content, $sub_content);
    }
    $this->render('blocks/user/footer');
    ?>
</body>

</html>