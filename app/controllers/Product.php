<?php

class Product extends Controller
{
    private $model;
    public $data = [];
    public $respone;
    public function __construct()
    {
        $this->respone = new Respone();
        $this->model = $this->model('ProductModel');
        if ($_SESSION['user']['role_id'] == 1) {
            $this->respone->redirect('home/index');
        } else if ($_SESSION['user']['role_id'] == 3) {
            $this->respone->redirect('permission/index');
        }
    }
    public function index()
    {
        if (empty($_SESSION['username'])) {
            $this->respone->redirect('');
        }
        // else if ($count > 0) {
        //     $this->respone->redirect('home/index');
        // } 
        else {
            $dataProduct = $this->model->getProductListForRole($_SESSION['user']['user_id']);
            $title = 'Danh sách sản phẩm';
            $this->data['sub_content']['product_list'] = $dataProduct;
            $this->data['page_title'] = $title;
            $this->data['content'] = 'products/index';
            $this->render('layouts/seller_layout', $this->data);
        }
    }
    public function addProduct()
    {
        $product_name = trim($_POST['product_name']);
        $detail = trim($_POST['detail']);
        $price = trim($_POST['price']);
        $inventory = $_POST['inventory'];
        $category = $_POST['category'];
        $user = $_SESSION['user'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date("Y-m-d H:i:s");
        $id = $user['user_id'];
        if (($_FILES['my_file']['name']) != '') {
            $type = $_FILES['my_file']['type'];
            $allowed = array("image/jpeg", "image/png");
            if (!in_array($type, $allowed)) {
                $_SESSION['message_summary'] = "";
                $_SESSION['img'] = 'Vui lòng chọn đúng file ảnh';
                $this->respone->redirect('product/index');
            }
            $_SESSION['img'] = "";
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/mvcproject/public/assets/user/images/';
            $file = $_FILES['my_file']['name'];
            $path = pathinfo($file);
            $fileName = $path['filename'];
            $ext = $path['extension'];
            $tempName = $_FILES['my_file']['tmp_name'];
            $pathFileNameExt = $target_dir . $fileName . "." . $ext;
            if (file_exists($pathFileNameExt)) {
            } else {
                move_uploaded_file($tempName, $pathFileNameExt);
            }
        }
        $param = [
            'product_name' => $product_name,
            'price' => $price,
            'detail' => $detail,
            'inventory' => $inventory,
            'image' => $file,
            'sale_id' => $id,
            'create_date' => $currentDate,
            'category_id' => $category,
        ];
        if (empty($product_name) || empty($price) || empty($detail) || empty($inventory)) {
            $_SESSION['message_summary'] = "Không được bỏ trống bất kỳ trường thông tin nào";
            $this->respone->redirect('product/index');
        } else {
            $this->model->createProduct($param);
            $_SESSION['message_summary'] = "";
            $this->respone->redirect('product/index');
        }
    }
    public function detailProduct($id)
    {
        $this->data['sub_content']['info'] = $this->model->detailProduct($id, $_SESSION['user']['user_id']);
        $this->data['sub_content']['category_list'] = $this->model->categoryList();
        $this->data['page_title'] = 'Chi Tiết Sản Phẩm';
        $this->data['content'] = 'products/detail';
        $this->render('layouts/seller_layout', $this->data);
    }

    public function editProduct()
    {
        $id = $_POST['product_id'];
        $product_name = trim($_POST['product_name']);
        $detail = trim($_POST['detail']);
        $price = trim($_POST['price']);
        $inventory = $_POST['inventory'];
        $category = $_POST['category'];
        $userID = $_SESSION['user']['user_id'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date("Y-m-d H:i:s");
        $detailProd = $this->model->detailProduct($id, $userID);
        if (($_FILES['my_file']['name']) != '') {
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/mvcproject/public/assets/user/images/';
            $file = $_FILES['my_file']['name'];
            $path = pathinfo($file);
            $fileName = $path['filename'];
            $ext = $path['extension'];
            $tempName = $_FILES['my_file']['tmp_name'];
            $pathFileNameExt = $target_dir . $fileName . "." . $ext;
            if (file_exists($pathFileNameExt)) {
                $_SESSION['check_img_exist'] = 'Ảnh đã tồn tại';
            } else {
                $_SESSION['check_img_exist'] = '';
                move_uploaded_file($tempName, $pathFileNameExt);
            }
        } else {
            $file = $detailProd['image'];
        }
        $param = [
            'product_id' => $id,
            'product_name' => $product_name,
            'price' => $price,
            'detail' => $detail,
            'inventory' => $inventory,
            'image' => $file,
            'category_id' => $category,
            'update_date' => $currentDate
        ];
        if (empty($product_name) || empty($price) || empty($detail) || empty($inventory)) {
            $_SESSION['message_summary'] = "Không được bỏ trống bất kỳ trường thông tin nào";
            $this->respone->redirect('product/detail/' . $id);
        } else {
            $this->model->editProduct($param);
            $_SESSION['message_summary'] = "";
            $this->respone->redirect('product/index');
        }
    }

    public function deleteProduct($id)
    {
        $this->model->deleteProduct($id);
        $this->respone->redirect('product/index');
    }

    public function order()
    {
        $this->data['sub_content']['order_list'] = $this->model->getOrderListByID($_SESSION['user']['user_id']);
        $this->data['page_title'] = 'Danh sách đặt hàng';
        $this->data['content'] = 'products/order';
        $this->render('layouts/seller_layout', $this->data);
    }

    public function cancelOrder()
    {
        if (isset($_POST['id_order'])) {
            $id = $_POST['id_order'];
            if (isset($_SESSION['username'])) {
                $detailOrder = $this->model->detailOrder($id);
                $product_id = $detailOrder[0]['product_id'];
                $totalProduct = $detailOrder[0]['totalProduct'];
                $inventory = $detailOrder[0]['inventory'];
                $updateQuantity = $inventory + $totalProduct;
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $updateTime = date("Y-m-d H:i:s");
                $this->model->cancelOrder($id, $updateTime);
                $this->model->updateQuantity($updateQuantity, $product_id);
                echo json_encode(array('isLogin' => true, 'status' => 'Đã Hủy', 'updateTime' => $updateTime));
            } else {
                json_encode(array('isLogin' => false));
            }
        } else {
            echo '<div class="alert alert-danger">
                    <strong>Danger!</strong> Hủy đơn hàng thất bại.
                  </div>';
        }
    }

    public function confirmOrder()
    {
        if (isset($_POST['id_order'])) {
            $id = $_POST['id_order'];
            if (isset($_SESSION['username'])) {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $updateTime = date("Y-m-d H:i:s");
                $this->model->confirmOrder($id, $updateTime);
                echo json_encode(array('isLogin' => true, 'status' => 'Đã xác nhận'));
            } else {
                json_encode(array('isLogin' => false));
            }
        } else {
            echo '<div class="alert alert-danger">
                    <strong>Danger!</strong> Xác nhận đơn hàng thất bại.
                  </div>';
        }
    }

    public function detailOrder($id)
    {
        $this->data['content'] = 'products/detailOrder';
        $this->data['sub_content']['info'] = $this->model->detailOrder($id);
        $this->render('layouts/seller_layout', $this->data);
    }

    public function hideProd($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date("Y-m-d H:i:s");
        $this->model->hide($id, $currentDate);
        $this->respone->redirect('permission/productlist');
    }
}
