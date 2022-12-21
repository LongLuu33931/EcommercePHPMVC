<?php

class Permission extends Controller
{
    private $respone;
    private $userModel;
    private $productModel;
    private $data;
    function __construct()
    {
        $this->userModel = $this->model('PermissionModel');
        $this->productModel = $this->model('ProductModel');
        $this->usModel = $this->model('UserModel');
        $this->respone = new Respone();
        if ($_SESSION['user']['role_id'] == 1) {
            $this->respone->redirect('home/index');
        } else if ($_SESSION['user']['role_id'] == 2) {
            $this->respone->redirect('product/index');
        }
    }

    public function index()
    {
        $this->data['content'] = 'permission/index';
        $this->data['page_title'] = "Danh sách người dùng";
        $this->data['sub_content']['page_title'] = "Danh sách người dùng";
        $this->data['sub_content']['user_list'] = $this->userModel->getUserList();
        $this->render('layouts/client_layout', $this->data);
    }

    public function detailUser($username)
    {
        $this->data['sub_content']['user_info'] = $this->userModel->detailUser($username);
        $this->data['content'] = 'permission/detail';
        $this->render('layouts/client_layout', $this->data);
    }

    public function seller()
    {
        $this->data['sub_content']['list_seller'] = $this->usModel->getSellerList();
        $this->data['content'] = 'permission/seller';
        $this->render('layouts/client_layout', $this->data);
    }

    public function productListBySeller($id)
    {
        $user = $this->usModel->getUserById($id);
        $this->data['sub_content']['user'] = $user;
        $this->data['sub_content']['product_list'] = $this->productModel->productListBySeller($id);
        $this->data['page_title'] = "Sản phẩm của " . $user['username'];
        $this->data['content'] = 'permission/productlistbyseller';
        $this->render('layouts/client_layout', $this->data);
    }

    public function editUserRole()
    {
        $username = $_POST['username'];
        $role = $_POST['role'];
        $count = $this->userModel->countRole();
        if (empty($role)) {
            $_SESSION['message_role'] = "Không được bỏ trống trường thông tin";
            $this->respone->redirect("permission/detailUser/" . $username);
        } else if ($role > $count) {
            $_SESSION['message_role'] = "";
            $_SESSION['message_roleValue'] = "Cập nhật không thành công";
            $this->respone->redirect("permission/detailUser/" . $username);
        } else {
            $_SESSION['message_role'] = "";
            $_SESSION['message_roleValue'] = "";
            $this->userModel->editUser($username, $role);
            $this->respone->redirect('permission/index');
        }
    }

    public function insertUser()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role_id = 1;
        $count = $this->userModel->checkUserExist($username);
        if (empty($username) || empty($password)) {
            $_SESSION['message_check'] = "Không được bỏ trống trường thông tin";
        }
        if ($count > 0) {
            $_SESSION['message_check'] = 'Tài khoản đã tồn tại';
        } else {
            $this->userModel->insertUser($username, $password, $role_id);
            $this->respone->redirect('permission/index');
        }
    }

    public function deleteUser($username)
    {
        $this->userModel->deleteUser($username);
        $this->respone->redirect('permission/index');
    }

    public function roleList()
    {
        $this->data['content'] = 'permission/roleList';
        $this->data['sub_content']['role_list'] = $this->userModel->roleList();
        $this->render('layouts/client_layout', $this->data);
    }

    public function insertRole()
    {
        $roleName = trim($_POST['rolename']);
        if (empty($roleName)) {
            $_SESSION['check_role_name'] = 'Không được để trống';
        } else {
            $_SESSION['check_role_name'] = '';
            $this->userModel->insertRole($roleName);
            $this->respone->redirect('permission/roleList');
        }
    }

    public function deleteRole($id)
    {
        $this->userModel->deleteRole($id);
        $this->respone->redirect('permission/roleList');
    }

    public function productList()
    {
        $this->data['sub_content']['product_list'] = $this->productModel->getProductList();
        $this->data['content'] = 'permission/productlist';
        $this->render('layouts/client_layout', $this->data);
    }

    public function detailProduct($id)
    {
        $this->data['sub_content']['info'] = $this->productModel->detailProductAdmin($id);
        $this->data['content'] = 'permission/detailproduct';
        $this->render('layouts/client_layout', $this->data);
    }

    public function approve($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date("Y-m-d H:i:s");
        $this->userModel->approve($id, $currentDate);
        $this->respone->redirect('permission/productlist');
    }

    public function hideProd($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date("Y-m-d H:i:s");
        $this->userModel->hide($id, $currentDate);
        $this->respone->redirect('permission/productlist');
    }
}
