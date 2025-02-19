<?php

class Db {
    protected static $connection;

    public function Connect() {
        if(!isset(self::$connection)) {
            //$config = parse_ini_file("config.ini");
            self::$connection = new mysqli("localhost", "root", "", "ecommerce");
        }
        if(self::$connection == false) {
            return false;
        }
        return self::$connection;
    }

    public function query_execute($queryString) {
        $connection = $this->Connect();
        $connection->query("SET NAMES utf8");
        $result = $connection->query($queryString);
        // $connection->close();
        return $result;
    }

    public function select_to_array($queryString) {
        $rows = array();
        $result = $this->query_execute($queryString);
        if($result == false) return false;
        while($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }
        return $rows;
    }
}

?>