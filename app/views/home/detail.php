<div id="message"></div>
<div class="small-container single-product">
    <div class="row">
        <div class='col-2'>
            <img src='<?php echo _WEB_ROOT ?>/public/assets/user/images/iconnew.png' width=70px>
            <img src='<?php echo _WEB_ROOT ?>/public/assets/user/Images/<?= $item['image'] ?>' width='100%' id='ProductImg'>
        </div>
        <div class='col-2'>
            <h1><?= $item["product_name"] ?></h1>
            <?php $amount = number_format($item["price"], 0, ",", "."); ?>
            <h3><strong>Cửa hàng:</strong> <?= $item['username'] ?></h3>
            <h4><?= $amount ?> VNĐ</h4>
            <input type='number' value='1' min='1' name='quantityItemName'>
            <a style="margin: 0;" class='btn' onclick="addToCart(this)" itemid='<?= $item['product_id'] ?>'>Thêm vào giỏ</a>
            <h3>Chi tiết sản phẩm <i class='fa fa-indent'></i></h3>
            <br>
            <p><?= $item['detail'] ?></p>
        </div>
    </div>
</div>

<script type="text/javascript">
    function addToCart(item) {
        var itemID = $(item).attr("itemid");
        var quantityItem = $("input[name=quantityItemName]").val();
        var cartCount = $('lblCartCount').text();
        let productRemaining = 0;
        async function getQuantity() {
            await $.ajax({
                async: true,
                type: "GET",
                data: {
                    id: itemID
                },
                url: "/mvcproject/home/getquantity",
                success: function(result) {
                    const data = JSON.parse(result);
                    productRemaining = data.quantity;
                },
                error: function(err) {
                    console.error(err);
                }
            });
            return productRemaining;
        }

        getQuantity().then(qty => {
            let buyQuantity = 0;
            if (qty > 0) {
                if (quantityItem === "" || quantityItem <= 0) {
                    buyQuantity = 1;
                    $("input[name=quantityItemName]").val(1);
                } else if (parseInt(quantityItem) <= parseInt(qty)) {
                    buyQuantity = quantityItem;
                } else {
                    buyQuantity = qty;
                    $("input[name=quantityItemName]").val(qty);
                    alert(`Bạn chỉ có thể mua tối đa ${qty} sản phẩm`);
                    return false;
                }
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "text",
                    data: {
                        product_id: itemID,
                        buyQuantity: buyQuantity
                    },
                    url: "/mvcproject/home/addToCart/",
                    success: function(result) {
                        const data = JSON.parse(result);
                        if (data.isLogin) {
                            const success = `
                            <div class="alert alert-success" style="text-align: center;">
                            <strong>Thành công !</strong> Đã thêm sản phẩm vào giỏ hàng.
                            </div> `;
                            $('#message').replaceWith(success);
                            if (data.cannotbuying) {
                                alert('Ban chỉ có thể mua tối đa ' + soluong + ' sản phẩm.')
                            }

                            $('#lblCartCount').text(data.cartCount);
                        } else {
                            const error = `
                            <div class="alert alert-warning" style="text-align: center;">
                            <strong>Cảnh báo !</strong> Bạn cần phải <a href="<?php echo _WEB_ROOT . '/account/index' ?>">đăng nhập</a> để mua sản phẩm.
                            </div>`;
                            $('#message').replaceWith(error);
                        }
                    },
                    error: function(err) {
                        console.error('err', err);
                    }
                });
            } else {
                alert("Sản phẩm đã hết hàng");
            }
        })
    }
</script>