<div class="main-content container-fluid">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Sản Phẩm</h4>
            </div>
            <div class="card-body">
                <div id="message"></div>
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="false" style="width:9%">Mã đơn hàng</th>
                            <th data-sortable="false">Người đặt</th>
                            <th data-sortable="false" style="width:9%">Trạng thái</th>
                            <th data-sortable="false">Ngày đặt</th>
                            <th data-sortable="false">Ngày cập nhật</th>
                            <th data-sortable="false">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_list as $item) : ?>
                            <?php $amount = number_format($item['Total'], 0, ",", "."); ?>
                            <tr>
                                <td>
                                    <?= $item['id_order'] ?>
                                </td>
                                <td>
                                    <?= $item['username'] ?>
                                </td>
                                <td id='status<?= $item['id_order'] ?>'>
                                    <?= $item['Statuses'] ?>
                                </td>
                                <td>
                                    <?= $item['StartDate'] ?>
                                </td>
                                <td id="updateTime<?= $item['id_order'] ?>">
                                    <?= $item['UpdateDate'] ?>
                                </td>
                                <td>
                                    <?= $amount ?>
                                </td>
                                <td>
                                    <a class='btn-primary' style="border-radius: 0.267rem; padding:0.467rem 0.5rem" href='<?php echo _WEB_ROOT ?>/product/detailOrder/<?= $item['id_order'] ?>'>Chi tiết</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </section>
</div>

<script>
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
                    $('#status' + id_order).text(data.status);
                    $('#updateTime' + id_order).text(data.updateTime)
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