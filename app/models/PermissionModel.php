<?php

class PermissionModel
{
    private $PDO;
    private $data;

    function __construct()
    {
        $this->PDO = new Database;
    }
    public function getUserList()
    {
        $sql = "SELECT * FROM user u INNER JOIN ROLE r ON u.role_id = r.id order by u.role_id DESC";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkUserExist($username)
    {
        $sql = $this->PDO->table('user')->where('username', '=', $username)->get();
        $count = count($sql);
        return $count;
    }

    public function insertUser($username, $password, $role_id)
    {
        $sql = "INSERT INTO user(username,password,role_id) values('$username','$password','$role_id')";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function detailUser($username)
    {
        $sql = "SELECT * FROM user  WHERE username = '$username' ";

        $this->data = $this->PDO->query($sql);

        return $this->data->fetch(PDO::FETCH_ASSOC);
        // $data = $this->PDO->table('user')->select()->where('username', '=', $username)->first();
        // return $data;
    }

    public function editUser($username, $role)
    {
        $sql = "UPDATE user set role_id = $role WHERE username = '$username'";
        $this->data = $this->PDO->query($sql);
    }

    public function deleteUser($username)
    {
        $this->db->table('user')->where('username', '=', $username)->delete();
    }

    public function countRole()
    {
        $sql = "SELECT COUNT(*) from role";
        $count = $this->PDO->query($sql);
        return $count->fetchColumn();
    }

    public function roleList()
    {
        $sql = "SELECT * from role";
        $this->data = $this->PDO->query($sql);
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertRole($roleName)
    {
        $sql = "INSERT INTO role(role_name) VALUES('$roleName')";
        echo $sql;
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function deleteRole($id)
    {
        $sql = "delete from role where id = '$id'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function approve($id, $updateTime)
    {
        $sql = "update product set approved = 1,update_date = '$updateTime' where product_id = '$id'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }

    public function hide($id, $updateTime)
    {
        $sql = "update product set approved = 0,update_date = '$updateTime' where product_id = '$id'";
        $this->data = $this->PDO->query($sql);
        return $this;
    }
}
