<?php

require_once("../../config/db.class.php");

class Product {
    public $productID;
    public $productName;
    public $cateID;
    public $Price;
    public $Quantity;
    public $Description;
    public $Picture;

    public function __construct($proName, $cate_ID, $Price, $Quantity, $Descript, $Picture) {
        $this->productName = $proName;
        $this->cateID = $cate_ID;
        $this->Price = $Price;
        $this->Quantity = $Quantity;
        $this->Description = $Descript;
        $this->Picture = $Picture;
    }

    public function Save() {
        $db = new Db();
        $sql = "INSERT INTO Product (productName, cateID, Price, Quantity, Description, Picture) VALUES 
                    ('$this->productName', '$this->cateID', '$this->Price', '$this->Quantity', '$this->Description', '$this->Picture')";
        $result = $db->query_execute($sql);
        return $result;
    }
    
    public static function listProduct() {
        $db = new Db();
        $sql = "SELECT * FROM product";
        $result = $db->select_to_array($sql);
        return $result;
    }
}

?>