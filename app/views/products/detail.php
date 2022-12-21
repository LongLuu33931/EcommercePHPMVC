<div class="container">
    <form action="<?php echo _WEB_ROOT ?>/product/editProduct/<?= $info['product_id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="product_id" class="form-control" value="<?= $info['product_id'] ?>" hidden>
            <div class="col-6">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="product_name" class="form-control" value="<?= $info['product_name'] ?>">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Chi tiết</label>
                    <input class="form-control" name="detail" value="<?= $info['detail'] ?>"></input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Giá</label>
                    <input class="form-control" name="price" value="<?= $info['price'] ?>"></input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Số lượng</label>
                    <input class="form-control" name="inventory" type="number" min="1" value="<?= $info['inventory'] ?>"></input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Danh Mục</label>
                    <select class="form-select" name="category" id="">
                        <?php foreach ($category_list as $item) : ?>
                            <option value="<?= $item['category_id'] ?>"><?= $item['category_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
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
                    <input type="file" name="my_file" accept="image/*">
                </div>
            </div class=" col-6">
            <div class="col-6"></div>
        </div>
        <div style="float: right;">
            <a class="btn btn-primary" href="<?= _WEB_ROOT . '/product/index' ?>">Trở về</a>
            <?php
            if ($info['approved'] == 1) {
            ?>
                <a href="<?= _WEB_ROOT . '/product/hideProd/' . $info['product_id'] ?>" type="submit" name="edit" class="btn btn-danger">Ẩn Sản Phẩm</a>
            <?php } ?>

            <button type="submit" name="edit" class="btn btn-primary">Sửa sản phẩm</button>
        </div>
    </form>
</div>