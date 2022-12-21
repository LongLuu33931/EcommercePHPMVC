<?php

class AccountModel extends Model
{
    private $PDO;
    private $data;
    function __construct()
    {
        $this->PDO = new Database();
    }

    function tableFill()
    {
        return 'user';
    }

    function fieldFill()
    {
        return '*';
    }

    function primaryKey()
    {
        return 'username';
    }

    public function getListUser($username)
    {
        $sql = "SELECT * FROM user where username = '$username'";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetch(PDO::FETCH_ASSOC);
    }

    public function checkAccount($username)
    {
        $sql = $this->PDO->table('user')->where('username', '=', $username)->get();
        $count = count($sql);
        return $count;
    }

    public function insertUser($param)
    {
        $this->PDO->table('user')->insert($param);
        return $this;
    }

    public function cartCount($username)
    {
        $sql = "SELECT * FROM cart WHERE username = '$username'";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }
}
