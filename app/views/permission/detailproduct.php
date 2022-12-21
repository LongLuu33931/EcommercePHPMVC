<div class="container">
    <form action="<?php echo _WEB_ROOT ?>/permission/approve/<?= $info['product_id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="product_id" class="form-control" value="<?= $info['product_id'] ?>" hidden>
            <div class="col-6">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="product_name" class="form-control" value="<?= $info['product_name'] ?>" disabled>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Chi tiết</label>
                    <input class="form-control" name="detail" value="<?= $info['detail'] ?>" disabled></input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Giá</label>
                    <input class="form-control" name="price" value="<?= $info['price'] ?>" disabled></input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Số lượng</label>
                    <input class="form-control" name="inventory" type="number" min="1" value="<?= $info['inventory'] ?>" disabled></input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Danh Mục</label>
                    <input class="form-control" name="category" type="text" min="1" value="<?= $info['category_name'] ?>" disabled></input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Ngày Tạo</label>
                    <input class="form-control" name="create_date" type="text" min="1" value="<?= $info['create_date'] ?>" disabled></input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Ngày Cập Nhật</label>
                    <input class="form-control" name="create_date" type="text" min="1" value="<?= $info['update_date'] ?>" disabled></input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group" style="display: flex; flex-direction: column;">
                    <label>Hình ảnh</label>
                    <img style="width:200px;height: 200px;" src="<?php echo _WEB_ROOT ?>/public/assets/user/images/<?= $info['image'] ?>" alt="">
                </div>
            </div class="col-6">
            <div class="col-6"></div>
        </div>
        <div style="float: right;">
            <a class="btn btn-primary" href="<?= _WEB_ROOT . '/permission/productlist' ?>">Trở về</a>
            <a href="<?= _WEB_ROOT . '/permission/hideProd/' . $info['product_id'] ?>" type="submit" name="edit" class="btn btn-danger">Ẩn Sản Phẩm</a>
            <?php
            if ($info['approved'] == 1) {
            ?>
            <?php } else { ?>

                <button type="submit" name="edit" class="btn btn-primary">Duyệt Sản Phẩm</button>
            <?php } ?>
        </div>
    </form>
</div>