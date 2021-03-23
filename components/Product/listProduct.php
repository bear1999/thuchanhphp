<?php require_once("../../Entities/Product.class.php"); ?>

<?php 
    include_once("../header.php");

    $products = Product::listProduct();

    foreach($products as $item) {
        echo "<p>Tên sản phẩm: " . $item['ProductName'] . "</p>";
        echo "<p>Mô tả sản phẩm: " . $item['Description'] . "</p>";
        echo "<p>Số lượng sản phẩm: " . $item['Quantity'] . "</p>";
    }

?>