<?php

?>
<div id="message"></div>
<div class="small-container cart-page">
    <?php if (empty($_SESSION['username'])) { ?>
        <div style="font-size: 20px; text-align: center; padding: 100px; background-color: #DCDCDC">Vui lòng <a href="<?= _WEB_ROOT . '/account/index' ?>" style="color: blue;">đăng nhập</a> để truy cập vào giỏ hàng.</div>

    <?php } else { ?>
        <h2 style="text-align: center;">Đơn Hàng</h2>
        <table>
            <thead>
                <th style="text-align: center; font-weight: bold;">Mã Đơn Hàng</th>
                <th style="text-align: center; font-weight: bold;">Trạng Thái</th>
                <th style="text-align: center; font-weight: bold;">Ngày Đặt</th>
                <th style="text-align: center; font-weight: bold;">Ngày Hủy</th>
                <th style="text-align: center; font-weight: bold;">Tổng tiền</th>
                <th></th>
            </thead>
            <tbody id='tbody'>
                <?php
                if (isset($order_list)) {
                    $finalAmount = 0;
                    foreach ($order_list as $item) :
                        $status = $item['Statuses'];
                        $totalAmount = $item['Total'];
                        $totalAmountFormat = number_format($totalAmount, 0, ",", ".");
                ?>

                        <tr id=''>
                            <td style="text-align: center;"><?= $item['id_order'] ?></td>
                            <td style="text-align: center;" id='status<?= $item['id_order'] ?>'><?= $status ?></td>
                            <td style="text-align: center;"><?= $item['StartDate'] ?></td>
                            <td style="text-align: center;"><?= $item['UpdateDate'] ?></td>
                            <td style="text-align: center;"><?= $totalAmountFormat ?> VND</td>
                            <td style="text-align: center;">
                                <a href="<?= _WEB_ROOT . '/home/detailOrder/' . $item['id_order'] ?>" id="cancel-btn" class="bt btn-primary" style="margin-top: 8px;">Chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                <?php } ?>
            </tbody>
        </table>
        <div style="margin: 8px 0;">
            <a style="text-decoration: none;" href='<?= _WEB_ROOT . "/home/index" ?>' class='bt btn-primary' style='font-weight: bold;'>Trở về trang chủ</a>
        </div>
    <?php } ?>
</div>

<script>
    function cancelOrder(item) {
        var id_order = $(item).attr("itemid");
        $.ajax({
            type: 'Post',
            data: {
                'id_order': id_order
            },
            url: '/mvcproject/home/cancelorder',
            success: function(result) {
                const data = JSON.parse(result);
                if (data.isLogin) {
                    $('#status' + id_order).text(data.status);
                    const success = `
                            <div class="alert alert-success" style="text-align: center;">
                            <strong>Hủy Đơn Thành Công !</strong>
                            </div> `;
                    $('#message').replaceWith(success);
                    $('#cancel-btn').remove();
                }

            }
        })
    }
</script>