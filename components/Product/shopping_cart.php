<?php 
include_once("../header.php");
require_once("../../Entities/Product.class.php");
require_once("../../Entities/Category.class.php");
$cates = Category::listCategory();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_GET["id"])) {
    $pro_id = $_GET["id"];
    $was_found = false;
    $i = 0;

    if(!isset($_SESSION["cart_items"]) || count($_SESSION["cart_items"]) < 1) {
        $_SESSION["cart_items"] = array(0 => array("pro_id" => $pro_id, "quantity" => 1));
    }
} else {
    foreach($_SESSION["cart_items"] as $item) {
        $i++;
        while(list($key, $value) = each($item)) {
            if($key == "pro_id" && $
            session_start();
            session_destroy();value == $pro_id) {
                array_splice($_SESSION["cart_tem"], $i-1, 1, array(array("pro_id" => $pro_id, "quantity" => $item["quantity"] + 1)));
                $was_found = true;
            }
        }
    }
    if($was_found == false) {
        array_push($_SESSION["cart_items"], array("pro_id" => $pro_id, "quanity" => 1));
    }
    header("Location: ./shopping_cart.php");
}
?>

<div class="container text-center">
    <div class="col-sm-3">
        <h3>Danh mục</h3>
        <ul class="list-group">
            <?php foreach ($cates as $item) { ?>
                <a href="./listProduct.php?cateid=<?php echo $item['CateID']; ?>" style="text-decoration: none;">
                    <li class="list-group-item"><?php echo $item['CateName']; ?></li>
                </a>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="col-sm-9">
    <h3>Thông tin giỏ hàng</h3>
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $total_money = 0;
                if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0) {
                    foreach($_SESSION["cart_items"] as $item) {
                        $id = $item["pro_id"];
                    }
                }
            ?>
        </tbody>
    </table>
</div>