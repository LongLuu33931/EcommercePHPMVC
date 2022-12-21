<?php

?>
<div class="small-container cart-page">
    <?php if (empty($_SESSION['username'])) { ?>
        <div style="font-size: 20px; text-align: center; padding: 100px; background-color: #DCDCDC">Vui lòng <a href="<?= _WEB_ROOT . '/account/index' ?>" style="color: blue;">đăng nhập</a> để truy cập vào giỏ hàng.</div>

    <?php } else { ?>
        <?php if (isset($_SESSION['check'])) { ?>
            <div class="alert alert-warning" style="text-align: center;">
                <strong><?php echo $_SESSION['check'] ?></strong>
            </div>
        <?php } ?>
        <table>
            <thead>
                <th style="font-weight: bold;">Sản phẩm</th>
                <th style="font-weight: bold;">Số lượng</th>
                <th style="font-weight: bold;">Tổng tiền</th>
            </thead>
            <tbody id='tbody'>
                <?php
                if (isset($cart_list)) {
                    $finalAmount = 0;
                    foreach ($cart_list as $item) :
                        $amount = number_format($item['UnitPrice'], 0, ",", ".");
                        $totalAmount = $item['UnitPrice'] * $item['QuantityBuying'];
                        $totalAmountFormat = number_format($totalAmount, 0, ",", ".");

                        $finalAmount += $totalAmount;
                        $finalAmountFormat = number_format($finalAmount, 0, ",", ".");
                ?>

                        <tr id='<?= $item['product_id'] ?>'>
                            <td style='width: 700px;'>
                                <div class='cart-info' style='flex-wrap: nowrap; padding: 15px;'>
                                    <img src='<?php echo _WEB_ROOT ?>/public/assets/user/images/<?= $item['image'] ?>'>
                                    <div>

                                        <p><?= $item['product_name'] ?></p>
                                        <small id='UnitPrice'>Giá: <?= $amount ?> VND</small>
                                        <br>
                                        <a style="font-weight: bold;" href="#" onclick="removeCart(this)" itemid='<?= $item['product_id'] ?>'>Xóa</a>
                                    </div>
                                </div>
                            </td>
                            <td><input style='width: 60px;' type='number' value='<?= $item['QuantityBuying'] ?>' min='1' name='quantityItemName' itemid='<?= $item['product_id'] ?>' data-content='<?= $item['UnitPrice'] ?>'></td>
                            <td itemid='<?= $item['product_id'] ?>'><?= $totalAmountFormat ?> VND</td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                <?php } ?>
                <table style="margin-top:16px">
                    <thead>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                    </thead>
                    <tbody style="margin-bottom:4px">
                        <form id="postInfo" method="POST" action="<?= _WEB_ROOT . "/home/order" ?>">
                            <tr>
                                <td>
                                    <input type="text" name="address" placeholder="Địa chỉ">
                                </td>
                                <td>
                                    <input type="text" name="phone" placeholder="Số điện thoại">
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </tbody>
        </table>
        <div style="margin: 8px 0; float:right;">
            <?php
            if (count($cart_list) > 0) { ?>
                <a style="text-decoration: none;" class='bt btn-primary' style='font-weight: bold;' id='orderButton'>Đặt hàng</a>
            <?php } else { ?>
                <a style="text-decoration: none;" href='<?= _WEB_ROOT . "/home/index" ?>' class='bt btn-primary' style='font-weight: bold;'>Trở về trang chủ</a>
            <?php } ?>

        </div>
        <div class="total-price" style='width:100%; display: flex; justify-content: space-between;'>

            <div>

            </div>
            <table>
                <tr>
                    <td>Tổng tiền</td>
                    <td id='ThanhTien'> <?= !empty($finalAmountFormat) ? $finalAmountFormat : "" ?> VND</td>
                </tr>
            </table>
        </div>
</div>
<?php } ?>
</div>

<script>
    function removeCart(item) {
        var itemID = $(item).attr("itemid");

        $.ajax({
            async: true,
            type: 'POST',
            data: {
                product_id: itemID
            },
            url: '/mvcproject/home/removeCart',
            success: function(result) {
                const data = JSON.parse(result);
                $('#lblCartCount').text(data.cartCount);
                $('#ThanhTien').text(data.Amount + ' VND');
                let amount = (data.Amount + data.Amount * 0.05);
                $('#ThanhTien_Thue').text(amount + ' VND');
                $("#" + itemID).remove();

            },
            error: function() {
                alert(data.message)
            }
        })
    }

    $(document).ready(function() {
        $("input[name=quantityItemName]").change(function() {
            var itemID = $(this).attr("itemid");
            var quantityItem = this.value;
            var cartCount = $('#lblCartCount').text();
            var UnitPrice = $(this).attr("data-content");
            let productRemaining = 0;
            async function getQuantity() {
                await $.ajax({
                    async: true,
                    type: 'get',
                    data: {
                        id: itemID
                    },
                    url: '/mvcproject/home/getquantity',
                    success: function(result) {
                        const data = JSON.parse(result);
                        productRemaining = data.quantity;
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
                return productRemaining;
            }

            getQuantity().then(qty => {
                let buyQuantity = 0;
                if (qty > 0) {
                    if (quantityItem === "" || quantityItem <= 0) {
                        buyQuantity = 1;
                        $("input[itemid=" + itemID + "]").val(1);
                    } else if (parseInt(quantityItem) <= parseInt(qty)) {
                        buyQuantity = quantityItem;
                    } else {
                        buyQuantity = qty;
                        $("input[itemid=" + itemID + "]").val(qty);
                        alert("Bạn chỉ có thể mua tối đa " + qty + " sản phẩm.");
                    }

                    $.ajax({
                        async: true,
                        type: 'post',
                        data: {
                            product_id: itemID,
                            buyQuantity: buyQuantity
                        },
                        url: '/mvcproject/home/editCart',
                        success: function(result) {
                            const data = JSON.parse(result);
                            if (data.cannotBuy) {
                                alert('Ban chỉ có thể mua tối đa ' + qty + ' sản phẩm.')
                            }
                            $('#lblCartCount').text(data.cartCount);
                            $('td[itemid=' + itemID + ']').text(UnitPrice * buyQuantity + ' VND');
                            $('#ThanhTien').text(data.Amount + ' VND');
                            let amount = (data.Amount + data.Amount * 0.05);
                            $('#ThanhTien_Thue').text(amount + ' VND');
                        },
                        error: function(err) {
                            console.error('err', err);
                        }
                    })
                } else {
                    alert("Sản phẩm này đã hết hàng xin hãy quay lại sau.")
                }
            })
        })

        $('#orderButton').click(function() {
            $('#postInfo').submit();
        })
    })
</script>