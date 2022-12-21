<?php

class HomeModel
{

    private $data;
    private $PDO;
    function __construct()
    {
        $this->PDO = new Database();
    }

    public function getListProduct()
    {
        $sql = "SELECT * FROM product p INNER JOIN user us ON p.sale_id = us.user_id where approved = 1";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll();
    }

    public function getDetailProduct($id)
    {
        $sql = "SELECT * FROM product p INNER JOIN user us ON p.sale_id = us.user_id  WHERE product_id = '$id' ";

        $this->data = $this->PDO->query($sql);

        return $this->data->fetch(PDO::FETCH_ASSOC);
    }
    public function checkQuantity($id)
    {
        $sql = "SELECT * FROM product where product_id = $id";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetch(PDO::FETCH_ASSOC);
    }
    public function checkCart($id, $username)
    {
        $sql = $this->PDO->table('cart')->select()->where('product_id', '=', $id)->where('username', '=', $username)->get();
        $count = count($sql);
        return $count;
    }

    public function check($id, $username)
    {
        $sql = "SELECT * from cart WHERE product_id='$id' and username ='$username'";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetch();
    }
    public function updateCart($quantity, $id, $username)
    {
        $sql = "UPDATE cart SET QuantityBuying = '$quantity' WHERE
        product_id = '$id' and username='$username'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function updateCartNotChange($inventory, $id, $username)
    {
        $sql = "UPDATE cart SET QuantityBuying = '$inventory' WHERE
        product_id = '$id' and username='$username'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function updateQuantity($updateQuantity, $id)
    {
        $sql = "UPDATE product set inventory ='$updateQuantity' WHERE product_id = '$id'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function addToCart($id, $name, $buy, $price, $img, $username, $sale_id)
    {
        $sql = " INSERT INTO cart (product_id ,product_name ,QuantityBuying ,UnitPrice ,image ,username,sale_id) VALUES('$id', '$name', '$buy', '$price', '$img', '$username','$sale_id') ";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function removeCart($id, $username)
    {
        $sql = "DELETE FROM cart WHERE product_id = '$id' and username='$username'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function cartCount($username)
    {
        $sql = "SELECT * FROM cart WHERE username = '$username'";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function order($username, $crdate, $Amount, $sale_id)
    {
        $sql = " INSERT INTO order_product(username, Statuses, StartDate, Total,sale_id) VALUES ('$username', 'Đang chuẩn bị', '$crdate', '$Amount','$sale_id') ";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function lastOrder()
    {
        $sql = "SELECT * from order_product ORDER BY id_order DESC LIMIT 1 ";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetch(PDO::FETCH_ASSOC);
    }

    public function insertDetailOrder($id, $product_id, $quantity, $price, $amount, $address, $phone)
    {
        $sql = "INSERT INTO detail_order (id_order,product_id,totalProduct,amount,totalAmount,address,phone) VALUES ('$id','$product_id','$quantity','$price','$amount','$address','$phone')";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function deleteCart($username)
    {
        $sql = "DELETE FROM cart WHERE username = '$username'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function getOrderList($username)
    {
        $sql = "SELECT id_order,username,Statuses,StartDate,UpdateDate,Total from order_product where username = '$username'";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detailOrder($id)
    {
        $sql = "SELECT * FROM detail_order do
        INNER JOIN order_product op ON op.id_order=do.id_order 
        INNER JOIN product p ON do.product_id=p.product_id where op.id_order=$id";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cancelOrder($id, $username, $updateTime)
    {
        $sql = "UPDATE order_product set statuses ='Đã Hủy',UpdateDate ='$updateTime' where id_order='$id' and username='$username'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function menProd()
    {
        $sql = "SELECT * FROM product WHERE category_id = 1";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function womanProd()
    {
        $sql = "SELECT * FROM product WHERE category_id = 2";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }
}
