<?php

class Account extends Controller
{
    public $userModel;
    public $productModel;
    public $data;
    public $respone;
    function __construct()
    {
        $this->respone = new Respone();
        $this->userModel = $this->model('AccountModel');
    }

    public function index()
    {
        if (isset($_SESSION['username'])) {
            $this->respone->redirect('product/index');
        }
        $this->data['content'] = 'account/index';
        $this->data['page_title'] = 'Tài khoản';
        $this->render("layouts/login_layout", $this->data);
    }

    public function register()
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirmPassword']);

        if (empty($username) || empty($password) || empty($confirmPassword)) {
            $_SESSION = array();
            $_SESSION["message_check"] = "Không được để trống bất kì trường thông tin";
            $this->respone->redirect('account/index');
        } else if (strlen($password) < 6) {
            $_SESSION = array();
            $_SESSION["message_check"] = "Mật khẩu phải từ 6 ký tự trở lên";
            $this->respone->redirect('account/index');
        } else if ($confirmPassword !== $password) {
            $_SESSION = array();
            $_SESSION["message_check"] = "Mật khẩu hoặc nhập lại mật khẩu sai";
            $this->respone->redirect('account/index');
        } else if (!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $username)) {
            $_SESSION = array();
            $_SESSION["message_check"] = "Tài khoản không hợp lệ";
        }
        $count = $this->userModel->checkAccount($username);
        if ($count > 0) {
            $_SESSION = array();

            $_SESSION["message_check"] = "Tài khoản đã tồn tại";
            $this->respone->redirect("account/index");
        } else {
            $param = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => 1
            ];

            $_SESSION['username'] = $username;
            $this->userModel->insertUser($param);
            $_SESSION['user'] = $this->userModel->getListUser($username);
            $this->respone->redirect('home/index');
        }
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // $count = $this->userModel->checkLogin($username, $password);

        $userRole = $this->userModel->getListUser($username);
        if (empty($username) && empty($password)) {
            $_SESSION = array();
            $_SESSION["message_usernameLogin"] = "Không được để trống trường này";
            $_SESSION["message_passwordLogin"] = "Không được để trống trường này";
            $this->respone->redirect('account/index');
        }
        if (empty($username)) {
            $_SESSION = array();
            $_SESSION["message_usernameLogin"] = "Không được để trống trường này";
            $this->respone->redirect('account/index');
        } else if (empty($password)) {
            $_SESSION = array();
            $_SESSION["message_passwordLogin"] = "Không được để trống trường này";
            $this->respone->redirect('account/index');
        }
        $profile =  $this->userModel->getListUser($username);

        if (password_verify($password, $profile['password'])) {
            $cartResult = $this->userModel->cartCount($username);
            $countRecord = 0;
            for ($i = 0; $i < count($cartResult); $i++) {
                $countRecord += $cartResult[$i]['QuantityBuying'];
            }
            $_SESSION['user'] =  $profile;
            $_SESSION['cartCount'] = $countRecord;
            $_SESSION['username'] = $username;
            if ($userRole['role_id'] == 1) {
                $this->respone->redirect("home/index");
            } else if ($userRole['role_id'] == 2) {
                $this->respone->redirect("product/index");
            } else {
                $this->respone->redirect("permission/index");
            }
        } else {
            $_SESSION = array();
            $_SESSION["message_checkLogin"] = "Sai tài khoản hoặc mật khẩu";
            $this->respone->redirect("account/index");
        }
    }

    public function logout()
    {
        session_destroy();
        $this->respone->redirect('home/index');
    }
}
