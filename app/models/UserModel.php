<?php

class UserModel
{

    private $data;
    private $PDO;
    function __construct()
    {
        $this->PDO = new Database();
    }

    public function checkUser($id)
    {
        $sql = "SELECT * FROM user where user_id = '$id'";
        return $this->PDO->query($sql);
    }

    public function getSellerList()
    {
        $sql = "SELECT * FROM user u INNER JOIN ROLE r ON u.role_id = r.id where u.role_id = 2";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM user where user_id = $id";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetch(PDO::FETCH_ASSOC);
    }
}
