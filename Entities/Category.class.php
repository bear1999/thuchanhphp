<?php

require_once("../../config/db.class.php");

class Category {
    public $cateID;
    public $categoryName;
    public $Description;

    public function __construct($cate_name, $desc) {
        $this->categoryName = $cate_name;
        $this->Description = $desc;
    }
    
    public static function listCategory() {
        $db = new Db();
        $sql = "SELECT * FROM category";
        $result = $db->select_to_array($sql);
        return $result;
    }
}

?>