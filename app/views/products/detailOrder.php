<div class="d-flex flex-column justify-content-center align-items-center" id="order-heading">
    <div class="text-uppercase">
        <p>Chi Tiết Đơn Hàng</p>
    </div>
    <div class="h4"></div>
    <div class="pt-1">
        <p>Đơn hàng <?php echo "#" . $info[0]['id_order'] ?> đang ở trạng thái<b class="text-dark" id="status"> <?php echo $info[0]['Statuses'] ?> </b></p>
    </div>
</div>
<div class="wrapper bg-white">
    <div id="message"></div>
    <div class="container">
        <table class="table table-borderless">
            <thead>
                <tr class="text-uppercase text-muted">
                    <th>Số lượng</th>
                    <th class="text-center">Sản phẩm</th>
                    <th class="text-right">Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $amount = 0;
                $totalAmount = 0;
                for ($i = 0; $i < count($info); $i++) {
                    $price = number_format($info[$i]['amount'], 0, ",", ".");
                    $total = $info[$i]['amount'] * $info[$i]['totalProduct'];
                    $amount += $total;
                    $amountFormat = number_format($amount, 0, ",", ".");
                ?>
                    <tr>
                        <td>
                            <div class=''> <?= $info[$i]['totalProduct'] ?></div>
                        </td>
                        <td>
                            <div class='order-item' style='margin-left: 20px'> <?= $info[$i]['product_name'] ?></div>
                        </td>
                        <td class='text-right'><b><?= $price ?> VND</b></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class='pt-2 border-bottom mb-3'></div>
        <div class='d-flex justify-content-start align-items-center py-1 pl-3'>
            <div class='text-muted'>Phí giao hàng</div>
            <div class='ml-auto'> <label>Miễn phí</label> </div>

        </div>
        <div class='d-flex justify-content-start align-items-center py-1 pl-3'>
            <div class='text-muted'>Thành Tiền</div>
            <div class='ml-auto'> <label class='text-right'> <?= $amountFormat ?> VND</label> </div>
        </div>
        <div class='row border rounded p-1 my-3'>
            <div class='col-md-6 py-3'>
                <div class='d-flex flex-column align-items start'> <b>Người đặt</b>
                    <?= $info[0]['username'] ?>
                </div>
                <div class='d-flex flex-column align-items start'> <b>Địa Chỉ Giao Hàng</b>
                    <?= $info[0]['address'] ?>
                </div>
                <div class='d-flex flex-column align-items start'> <b>Số điện thoại</b>
                    <?= $info[0]['phone'] ?>
                </div>
            </div>
        </div>
        <div style="float: right;">
            <a href="<?= _WEB_ROOT . "/product/order" ?>" class="btn btn-primary">Trở Về</a>
            <?php if ($info[0]['Statuses'] == 'Đã Hủy') { ?>
            <?php } else if ($info[0]['Statuses'] == 'Đã Xác Nhận') { ?>
                <a id="cancel-btn" class='btn btn-danger' style="" name='delete' itemid='<?= $info[0]['id_order'] ?>' onclick="cancelOrder(this)">Hủy Đơn</a>

            <?php } else { ?>
                <a id="cancel-btn" class='btn btn-danger' style="" name='delete' itemid='<?= $info[0]['id_order'] ?>' onclick="cancelOrder(this)">Hủy Đơn</a>
                <a id="confirm-btn" class="btn btn-primary" style="" itemid="<?= $info[0]['id_order'] ?>" onclick="confirmOrder(this)">Xác Nhận Đơn</a>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    function confirmOrder(item) {
        var id = $(item).attr('itemid');
        $.ajax({
            type: 'Post',
            data: {
                'id_order': id
            },
            url: '/mvcproject/product/confirmOrder',
            success: function(result) {
                debugger
                const data = JSON.parse(result);
                if (data.isLogin) {
                    $('#status').text(" " + data.status);
                    const success = `
                            <div class="alert alert-success" style="text-align: center;">
                            <strong>Xác Nhận Đơn Thành Công !</strong>
                            </div> `;
                    $('#message').replaceWith(success);
                    $('#confirm-btn').remove();
                }
            }
        })
    }

    function cancelOrder(item) {
        var id_order = $(item).attr("itemid");
        $.ajax({
            type: 'Post',
            data: {
                'id_order': id_order
            },
            url: '/mvcproject/product/cancelorder',
            success: function(result) {
                debugger
                const data = JSON.parse(result);
                if (data.isLogin) {
                    $('#status').text(" " + data.status);
                    $('#updateTime' + id_order).text(data.updateTime)
                    const success = `
                            <div class="alert alert-success" style="text-align: center;">
                            <strong>Hủy Đơn Thành Công !</strong>
                            </div> `;
                    $('#message').replaceWith(success);
                    $('#confirm-btn').remove();
                    $('#cancel-btn').remove();
                }

            }
        })
    }
</script>