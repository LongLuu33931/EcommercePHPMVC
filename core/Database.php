<?php

class Database
{
    private $__conn;
    private $statement;
    use QueryBuilder;

    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }
    //Them du lieu
    function insertData($table, $data)
    {
        if (!empty($data)) {
            $strKey = '';
            $strValue = '';
            foreach ($data as $key => $value) {
                $strKey .= $key . ",";
                $strValue .=  ":" . $key . ",";
            }

            $strKey = rtrim($strKey, ',');
            $strValue = rtrim($strValue, ',');

            $sql = "INSERT INTO $table($strKey) VALUES ($strValue)";

            $status = $this->query($sql, $data);

            if ($status) {
                return true;
            }
        }
        return false;
    }
    //cap nhat du lieu
    function updateData($table, $data, $condition = '')
    {
        if (!empty($data)) {
            $updateStr = '';
            foreach ($data as $key => $value) {
                $updateStr .= "$key='$value',";
            }
            $updateStr = rtrim($updateStr, ',');
            echo $updateStr;
            if (!empty($condition)) {
                $sql = "UPDATE $table SET $updateStr WHERE $condition";
            } else {
                $sql = "UPDATE $table SET $updateStr";
            }

            $status = $this->query($sql);
            if ($status) {
                return true;
            }
        }
        return false;
    }
    //Xoa du lieu
    function deleteData($table, $condition = '')
    {
        if (!empty($condition)) {
            $sql = 'DELETE FROM ' . $table . ' WHERE ' . $condition;
        } else {
            $sql = 'DELETE FROM' . $table;
        }

        $status = $this->query($sql);

        if ($status) {
            return true;
        }
        return false;
    }
    //truy van sql
    function query($sql, $param = [])
    {
        try {
            $this->statement = $this->__conn->prepare($sql);
            if (!empty($param)) {
                $this->statement->execute($param);
            } else {
                $this->statement->execute();
            }
            return $this->statement;
        } catch (Exception $ex) {
            $mess = $ex->getMessage();
            $data['message'] = $mess;
            App::$app->loadError('database', $data);
            die();
        }
    }
    //tra ve moi nhat sau khi da insert
    function lastInsertId()
    {
        return $this->__conn->lastInsertId();
    }
}
