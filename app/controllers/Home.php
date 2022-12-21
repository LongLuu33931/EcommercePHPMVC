<?php

class Home extends Controller
{
    private $product;
    private $data;
    private $respone;
    private $PDO;
    private $user;
    public function __construct()
    {
        $this->product = $this->model('HomeModel');
        $this->user = $this->model('UserModel');
        $this->respone = new Respone();
        $this->PDO = new Database();
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role_id'] == 2) {
                $this->respone->redirect('product/index');
            } else if ($_SESSION['user']['role_id'] == 3) {
                $this->respone->redirect('permission/index');
            }
        }
    }
    public function index()
    {
        $this->data['content'] = 'home/index';
        $this->data['sub_content']['product_list'] = $this->product->getListProduct();
        $this->render('layouts/user_layout', $this->data);
    }

    public function detail($id)
    {
        $this->data['content'] = 'home/detail';
        $this->data['sub_content']['item'] = $this->product->getDetailProduct($id);
        $this->data['page_title'] = "Chi tiết sản phẩm";
        $this->render('layouts/cart_layout', $this->data);
    }

    public function cart()
    {
        $this->data['content'] = 'home/cart';
        $this->data['page_title'] = 'Giỏ hàng';
        if (isset($_SESSION['username'])) {
            $this->data['sub_content']['cart_list'] = $this->product->cartCount($_SESSION['username']);
        }
        $this->render('layouts/cart_layout', $this->data);
    }

    public function getquantity()
    {
        if (isset($_GET['id']) || $_REQUEST['id']) {
            $id = $_GET['id'];
            $data = $this->product->checkQuantity($id);
            echo json_encode(array('quantity' => $data['inventory'],));
        } else {
            echo 'false';
        }
    }

    public function addToCart()
    {
        if (isset($_POST['product_id']) && isset($_POST['buyQuantity'])) {
            $id = $_POST['product_id'];
            $buyQuantity = $_POST['buyQuantity'];

            if (isset($_SESSION['username'])) {
                $data = $this->product->getDetailProduct($id);
                $cannotBuy = false;

                if ($data) {
                    $id = $data['product_id'];
                    $name = $data['product_name'];
                    $inventory = $data['inventory'];
                    $buy = $buyQuantity;
                    $price = $data['price'];
                    $img = $data['image'];
                    $sale_id = $data['sale_id'];
                    $username = $_SESSION['username'];
                    $cartData = $this->product->checkCart($id, $username);
                    $dataCartUser = $this->product->check($id, $username);
                    $previousQuantity = 0;
                    if ($cartData == 1) {
                        $previousQuantity = $dataCartUser['QuantityBuying'];
                        $allQuantity = (int)$previousQuantity + (int)$buyQuantity;
                        $updateQuantity = $inventory - $allQuantity;
                        //check in warehouse & all buy quantity

                        if ($allQuantity <= $inventory) {
                            $this->product->updateCart($allQuantity, $id, $username);
                            $this->product->updateQuantity($updateQuantity, $id);
                        } else {
                            $this->product->updateCartNotChange($inventory, $id, $username);
                            $cannotBuy = true;
                        }
                    } else {
                        $updateQuantity = $inventory - $buy;
                        $this->product->addToCart($id, $name, $buy, $price, $img, $username, $sale_id);
                        $this->product->updateQuantity($updateQuantity, $id);
                    }
                }
                $cartResult = $this->product->cartCount($username);
                $countRecord = 0;
                for ($i = 0; $i < count($cartResult); $i++) {
                    $countRecord += $cartResult[$i]['QuantityBuying'];
                }
                $_SESSION['cartCount'] = $countRecord;
                echo json_encode(array('isLogin' => true, 'cannotBuy' => $cannotBuy, 'cartCount' => $countRecord));
            } else echo json_encode(array('isLogin' => false));
        } else {
            echo "<script type='text/javascript'>alert('Thêm Vào Giỏ Hàng Thất Bại');</script>";
        }
    }


    public function editCart()
    {
        if (isset($_POST['product_id']) && isset($_POST['buyQuantity'])) {
            $id = $_POST['product_id'];
            $buyQuantity = $_POST['buyQuantity'];

            if (isset($_SESSION['username'])) {
                $data = $this->product->getDetailProduct($id);

                $cannotBuy = false;

                if ($data) {
                    $id = $data['product_id'];
                    $name = $data['product_name'];
                    $inventory = $data['inventory'];
                    $buy = $buyQuantity;
                    $price = $data['price'];
                    $img = $data['image'];
                    $username = $_SESSION['username'];

                    if ($buyQuantity <= $inventory) {
                        $this->product->updateCart($buyQuantity, $id, $username);
                    } else {
                        $this->product->updateCartNotChange($inventory, $id, $username);
                        $cannotBuy = true;
                    }
                }
                $cartResult = $this->product->cartCount($username);
                $countRecord = 0;
                for ($i = 0; $i < count($cartResult); $i++) {
                    $countRecord += $cartResult[$i]['QuantityBuying'];
                    $Amount = $cartResult[$i]['QuantityBuying'] * $cartResult[$i]['UnitPrice'];
                }
                $_SESSION['cartCount'] = $countRecord;
                echo json_encode(array('isLogin' => true, 'cannotBuy' => $cannotBuy, 'cartCount' => $countRecord, 'Amount' => $Amount));
            } else {
                echo json_encode(array('isLogin' => false));
            }
        } else {
            echo '<div class="alert alert-danger">
            <strong>Danger!</strong> Thêm sản phẩm vào giỏ hàng thất bại.
          </div>';
        }
    }

    public function order()
    {
        if (isset($_SESSION['username'])) {
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $username = $_SESSION['username'];
            $cartResult = $this->product->cartCount($username);
            $Amount = 0;
            $sale_id = 0;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentDate = date("Y-m-d H:i:s");
            if (empty($address) || empty($phone)) {
                $message = "Vui lòng nhập địa chỉ hoặc số điện thoại";
                $_SESSION['check'] = $message;
                $this->respone->redirect('home/cart');
            } else if (!preg_match('/^[0-9]{10}+$/', $phone)) {
                $message = "Số điện thoại không hợp lệ";
                $_SESSION['check'] = $message;
                $this->respone->redirect('home/cart');
            }
            $_SESSION['check'] = '';
            $totalAmount = 0;
            $orders = [];
            for ($i = 0; $i < count($cartResult); $i++) {
                if (!isset($orders[$cartResult[$i]['sale_id']])) {
                    $orders[$cartResult[$i]['sale_id']] = [];
                }
                $orders[$cartResult[$i]['sale_id']][] = $cartResult[$i];
            }
            foreach ($orders as $seller => $val) {
                $Amount = 0;
                $last_order = $this->product->lastOrder();
                $id_order = $last_order['id_order'] + 1;
                if ($this->user->checkUser($seller)) {
                    foreach ($val as $item) {
                        $Amount += $item['QuantityBuying'] * $item['UnitPrice'];
                        $totalAmount = $item['QuantityBuying'] * $item['UnitPrice'];
                        $this->product->insertDetailOrder($id_order, $item['product_id'], $item['QuantityBuying'], $item['UnitPrice'], $totalAmount, $address, $phone);
                    }
                }
                $this->product->order($username, $currentDate, $Amount, $seller);
            }
            $url = _WEB_ROOT . '/home/orderlist';
            $this->product->deleteCart($username);
            $_SESSION['cartCount'] = 0;
            echo '<div style="font-size: 20px; text-align: center; padding: 100px; background-color: #DCDCDC"> Đặt đơn thành công. <a href="' . $url . '" style="text-decoration: none;">Nhấn vào đây</a> để kiểm tra đơn hàng.</div>';
        } else {
            echo '<script>alert("Đặt hàng thất bại")</scrip>';
        }
    }

    public function orderList()
    {
        if (isset($_SESSION['username'])) {
            $this->data['content'] = 'home/order';
            $this->data['page_title'] = 'Đơn Hàng';
            if (isset($_SESSION['username'])) {
                $this->data['sub_content']['order_list'] = $this->product->getOrderList($_SESSION['username']);
            }
            $this->render('layouts/cart_layout', $this->data);
        } else {
            $this->respone->redirect('home/index');
        }
    }

    public function removeCart()
    {
        if (isset($_POST['product_id'])) {
            $id = $_POST['product_id'];
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $this->product->removeCart($id, $username);
                $cartResult = $this->product->cartCount($username);
                $countRecord = 0;
                $Amount = 0;
                for ($i = 0; $i < count($cartResult); $i++) {
                    $countRecord += $cartResult[$i]['QuantityBuying'];
                    $Amount = $cartResult[$i]['QuantityBuying'] * $cartResult[$i]['UnitPrice'];
                }
                $_SESSION['cartCount'] = $countRecord;
                echo json_encode(array('isLogin' => true, 'cartCount' => $countRecord, 'Amount' => $Amount));
            } else {
                echo json_encode(array('isLogin' => false));
            }
        } else {
            echo '<div class="alert alert-danger">
                    <strong>Danger!</strong> Xóa sản phẩm thất bại.
                  </div>';
        }
    }

    public function detailOrder($id)
    {
        $this->data['sub_content']['info'] = $this->product->detailOrder($id);
        // print_r($this->data['sub_content']['info']);
        // die();
        $this->data['content'] = 'home/detailorder';
        $this->render('layouts/cart_layout', $this->data);
    }

    public function cancelOrder()
    {
        if (isset($_POST['id_order'])) {
            $id = $_POST['id_order'];
            if (isset($_SESSION['username'])) {
                $detailOrder = $this->product->detailOrder($id);
                $product_id = $detailOrder[0]['product_id'];
                $totalProduct = $detailOrder[0]['totalProduct'];
                $inventory = $detailOrder[0]['inventory'];
                $updateQuantity = $inventory + $totalProduct;
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $updateTime = date("Y-m-d H:i:s");
                $username = $_SESSION['username'];
                $this->product->cancelOrder($id, $username, $updateTime);
                $this->product->updateQuantity($updateQuantity, $product_id);
                echo json_encode(array('isLogin' => true, 'status' => 'Đã Hủy'));
            } else {
                json_encode(array('isLogin' => false));
            }
        } else {
            echo '<div class="alert alert-danger">
                    <strong>Danger!</strong> Xác nhận đơn hàng thất bại.
                  </div>';
        }
    }

    public function men()
    {
        $this->data['sub_content']['product_list'] = $this->product->menProd();
        $this->data['content'] = 'home/men';
        $this->render('layouts/user_layout2', $this->data);
    }

    public function woman()
    {
        $this->data['sub_content']['product_list'] = $this->product->womanProd();
        $this->data['content'] = 'home/woman';
        $this->render('layouts/user_layout2', $this->data);
    }
}
