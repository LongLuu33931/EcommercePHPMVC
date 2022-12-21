<?php

class Connection
{
    private static $instance = null, $conn = null;

    private function __construct($config)
    {
        // print_r($config);
        try {
            $con = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['user'], $config['password']);
            self::$conn = $con;
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            App::$app->loadError('database', ['message' => $mess]);
            die();
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            $connection = new Connection($config);
            self::$instance = self::$conn;
        }
        return self::$instance;
    }
}
