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
    public $productBrand;
    public $productRam;
    public $productStorage;
    public $productCamera;

    public function __construct($proName, $cate_ID, $Price, $Quantity, $Descript, $Picture, $productBrand, $productRam, $productStorage, $productCamera)
    {
        $this->productName = $proName;
        $this->cateID = $cate_ID;
        $this->Price = $Price;
        $this->Quantity = $Quantity;
        $this->Description = $Descript;
        $this->Picture = $Picture;
        $this->productBrand = $productBrand;
        $this->productRam = $productRam;
        $this->productStorage = $productStorage;
        $this->productCamera = $productCamera;
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
        $sql = "INSERT INTO product (ProductName, CateID, PriceProduct, Quantity, Description, Picture, productBrand, productRam, productStorage, productCamera) VALUES 
                ('$this->productName', '$this->cateID', '$this->Price', '$this->Quantity', '$this->Description', '$nameFile', '$this->productBrand', '$this->productRam', '$this->productStorage', '$this->productCamera')";
        $result = $db->query_execute($sql);
        return $result;
    }

    public static function totalRecordsByCateID($cate) {
        $db = new Db();
        $sql = "SELECT COUNT(ProductID) AS Total FROM product WHERE CateID = '$cate'";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function totalPageByCateID($cate, $lm) {
        foreach(Product::totalRecordsByCateID($cate) as $item) 
            $total_records = $item["Total"];

        if(isset($lm))
            $limit = $lm;
        else $limit = 1;
        $total_page = ceil($total_records / $limit);
        return $total_page;
    }

    public static function totalRecords() {
        $db = new Db();
        $sql = "SELECT COUNT(ProductID) AS Total FROM product";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function totalPage($lm) {
        foreach(Product::totalRecords() as $item) 
            $total_records = $item["Total"];

        if(isset($lm))
            $limit = $lm;
        else $limit = 1;
        $total_page = ceil($total_records / $limit);
        return $total_page;
    }

    public static function listProduct($page, $lm)
    {
        $db = new Db();

        foreach(Product::totalRecords() as $item) 
            $total_records = $item["Total"];

        $current_page = isset($page) ? $page : 1;
        
        if(isset($lm))
            $limit = $lm;
        else $limit = 1;

        $total_page = ceil($total_records / $limit);
        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        // Tìm Start
        $start = ($current_page - 1) * $limit;

        $sql = "SELECT * FROM product LIMIT $start, $limit";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function list_product_by_cateid($cateid, $page, $lm)
    {
        $db = new Db();

        foreach(Product::totalRecordsByCateID($cateid) as $item) 
            $total_records = $item["Total"];

        $current_page = isset($page) ? $page : 1;

        if(isset($lm))
            $limit = $lm;
        else $limit = 1;

        $total_page = ceil($total_records / $limit);
        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        // Tìm Start
        $start = ($current_page - 1) * $limit;

        $sql = "SELECT * FROM product WHERE CateID = '$cateid' LIMIT $start, $limit";
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

    public static function listPagination() {
        $db = new Db();

        foreach(totalRecords() as $item) 
            $totalRecords = $item["Total"];

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 1;

        $total_page = ceil($total_records / $limit);
        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        // Tìm Start
        $start = ($current_page - 1) * $limit;

        $sql = "SELECT * FROM product LIMIT $start, $limit";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
