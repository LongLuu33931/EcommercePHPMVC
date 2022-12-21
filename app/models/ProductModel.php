<?php
class ProductModel
{
    private $PDO;
    private $data;
    private $conn;
    function __construct()
    {
        $this->PDO = new Database();
    }


    public function getProductList()
    {
        $sql = "SELECT * FROM product inner join user on sale_id = user_id order by product_id DESC";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll();
    }

    public function getProductListForRole($id)
    {
        $sql = "SELECT * FROM product where sale_id = '$id'  order by product_id DESC";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll();
    }

    public function detailProduct($id, $sale_id)
    {

        $sql = "SELECT * FROM product WHERE product_id = '$id' and sale_id = '$sale_id'";

        $this->data = $this->PDO->query($sql);

        return $this->data->fetch(PDO::FETCH_ASSOC);
    }

    public function detailProductAdmin($id)
    {

        $sql = "SELECT * FROM product p INNER JOIN category c ON p.category_id = c.category_id WHERE product_id = '$id'";

        $this->data = $this->PDO->query($sql);

        return $this->data->fetch(PDO::FETCH_ASSOC);
    }

    public function checkProduct($product_id)
    {
        $sql = $this->PDO->table("product")->select()->where("product_id", "=", $product_id)->get();
        $count = count($sql);
        return $count;
    }

    public function createProduct($param)
    {
        $sql = "INSERT INTO product(product_name,price,detail,inventory,image,sale_id,create_date,approved,category_id) VALUES(:product_name,:price,:detail,:inventory,:image,:sale_id,:create_date,0,:category_id)";
        $this->data = $this->PDO->query($sql, $param);
        return $this;
    }

    public function editProduct($param)
    {
        $sql = "UPDATE product set product_name=:product_name,price=:price,detail=:detail,inventory=:inventory,image=:image,category_id=:category_id,update_date=:update_date where product_id =:product_id";
        $this->data = $this->PDO->query($sql, $param);
        return $this;
    }

    public function deleteProduct($id)
    {
        $param = [
            'product_id' => $id
        ];
        $sql = "DELETE FROM product WHERE product_id=:product_id";
        $this->data = $this->PDO->query($sql, $param);
        return $this;
    }

    public function getOrderList()
    {
        $sql = "SELECT id_order,username,Statuses,StartDate,UpdateDate,Total from order_product";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderListByID($id)
    {
        $sql = "SELECT * from order_product where sale_id='$id'";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cancelOrder($id, $updateTime)
    {
        $sql = "UPDATE order_product set statuses ='Đã Hủy',UpdateDate ='$updateTime' where id_order='$id'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function confirmOrder($id, $updateTime)
    {
        $sql = "UPDATE order_product set statuses ='Đã Xác Nhận',UpdateDate ='$updateTime' where id_order='$id'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function updateQuantity($updateQuantity, $id)
    {
        $sql = "UPDATE product set inventory ='$updateQuantity' WHERE product_id = '$id'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function detailOrder($id)
    {
        $sql = "SELECT * FROM detail_order do
        INNER JOIN order_product op ON op.id_order=do.id_order 
        INNER JOIN product p ON do.product_id=p.product_id where op.id_order=$id";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($username)
    {
        $sql = "SELECT * FROM user where username = '$username'";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetch(PDO::FETCH_ASSOC);
    }

    public function categoryList()
    {
        $sql = "SELECT * FROM category";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hide($id, $updateTime)
    {
        $sql = "update product set approved = 0,update_date = '$updateTime' where product_id = '$id'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function productListBySeller($id)
    {
        $sql = "SELECT * from product where sale_id = '$id'";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }
}
