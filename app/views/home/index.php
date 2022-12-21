<div class="small-container">
    <h2 class="title"> Đồng Hồ </h2>
    <div class="row">
        <?php
        foreach ($product_list as $item) :
            $amount = number_format($item['price'], 0, ",", ".");
        ?>
            <div class='col-4'>
                <a href='<?php echo _WEB_ROOT ?>/home/detail/<?= $item['product_id'] ?>'><img src='<?php echo _WEB_ROOT ?>/public/assets/user/images/<?= $item['image'] ?>'></a>
                <a href='<?php echo _WEB_ROOT ?>/home/detail/<?= $item['product_id'] ?>'>
                    <h4 style="height: 80px;"><?= $item['product_name'] ?></h4>
                </a>
                <div class='ratting'>
                    <strong>Cửa hàng:</strong>
                    <?= $item['username'] ?>
                </div>
                <p>
                <h3><?= $amount ?> VND</h3>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>