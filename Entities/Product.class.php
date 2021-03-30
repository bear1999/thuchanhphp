<?php

require_once("../../config/db.class.php");

class Product
{
    public $productID;
    public $productName;
    public $cateID;
    public $Price;
    public $Quantity;
    public $Description;
    public $Picture;

    public function __construct($proName, $cate_ID, $Price, $Quantity, $Descript, $Picture)
    {
        $this->productName = $proName;
        $this->cateID = $cate_ID;
        $this->Price = $Price;
        $this->Quantity = $Quantity;
        $this->Description = $Descript;
        $this->Picture = $Picture;
    }

    public function save()
    {
        // Up image
        $file_temp = $this->Picture['tmp_name'];
        $user_file = $this->Picture['name'];
        $timestamp = date("Y") . date("m") . date("d") . date("h") . date("i") . date("s");
        $filepath = "../../public/imageProduct/";
        $nameFile = $timestamp . $user_file;
        if (move_uploaded_file($file_temp, $filepath . $nameFile) == false)
            return false;

        $db = new Db();
        $sql = "INSERT INTO product (ProductName, CateID, PriceProduct, Quantity, Description, Picture) VALUES 
                ('$this->productName', '$this->cateID', '$this->Price', '$this->Quantity', '$this->Description', '$nameFile')";
        $result = $db->query_execute($sql);
        return $result;
    }

    public static function listProduct()
    {
        $db = new Db();
        $sql = "SELECT * FROM product";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function list_product_by_cateid($cateid)
    {
        $db = new Db();
        $sql = "SELECT * FROM product WHERE CateID = '$cateid'";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function list_product_relate($cateid, $id)
    {
        $db = new Db();
        $sql = "SELECT * FROM product WHERE CateID = '$cateid' AND ProductID != '$id'";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function get_product($id)
    {
        $db = new Db();
        $sql = "SELECT * FROM product WHERE ProductID = '$id'";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
