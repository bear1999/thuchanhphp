<?php
require_once("../../Entities/Product.class.php");
require_once("../../Entities/Category.class.php");
?>

<?php
include_once("../header.php");
if(!isset($_GET["cateid"])) {
    $products = Product::listProduct();
} else {
    $cateid = $_GET["cateid"];
    $products = Product::list_product_by_cateid($cateid);
}
$cates = Category::listCategory();
?>
<div class="row container">
    <div class="col-sm-3">
        <br>
        <ul class="list-group">
            <?php foreach ($cates as $item) { ?>
                <a href="./listProduct.php?cateid=<?php echo $item['CateID'] ?>" style="text-decoration: none;">
                    <li class="list-group-item"><?php echo $item['CateName'] ?></li>
                </a>
            <?php } ?>
        </ul>
    </div>

    <div class="col-sm-9">
        <h3 class="text-center">Sản phẩm cửa hàng</h3>
        <div class="row">
            <?php foreach ($products as $item) { ?>
                <div class="col-sm-4">
                    <img src="<?php echo "../../public/imageProduct/" . $item['Picture'] ?>" class="img-reponsive" style="width: 100%" alt="Image">
                    <p class="text-danger">Tên sản phẩm: <?php echo $item['ProductName'] ?></p>
                    <p class="text-info">Giá: <?php echo $item['PriceProduct'] ?></p>
                    <p>
                        <button type="button" class="btn btn-primary">Mua hàng</button>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include_once("../footer.php"); ?>