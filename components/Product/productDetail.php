<?php
require_once("../../Entities/Product.class.php");
require_once("../../Entities/Category.class.php");
?>

<?php
include_once("../header.php");
if (!isset($_GET['id'])) {
    header("Location: ../not_found.php");
} else {
    $id = $_GET['id'];
    $product = reset(Product::get_product($id));
    $product_relate = Product::list_product_relate($product["CateID"], $id);
}
$cates = Category::listCategory();
?>

<div class="row container">
    <div class="col-sm-3 panel panel-danger">
        <h3 class="panel-heading">Danh mục</h3>
        <ul class="list-group">
            <?php foreach ($cates as $item) { ?>
                <a href="./listProduct.php?cateid=<?php echo $item['CateID']; ?>" style="text-decoration: none;">
                    <li class="list-group-item"><?php echo $item['CateName']; ?></li>
                </a>
            <?php } ?>
        </ul>
    </div>
    <div class="col-sm-9 panel panel-info">
        <div style="padding-top: 10px;"></div>
        <h3 class="text-center">
            <div class="alert alert-primary">
               <span style="color: black;">Chi tiết sản phẩm</span>
            </div>
        </h3>
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo "../../public/imageProduct/" . $product['Picture']; ?>" class="img-reponsive" style="width: 100%" alt="Image">
            </div>
            <div class="col-sm-6">
                <div style="padding-left: 10px;">
                    <h3 class="text-info">
                        <?php echo $product["ProductName"]; ?>
                    </h3>
                    <p>
                        Giá: <?php echo $product["PriceProduct"]; ?>
                    </p>
                    <p>
                        Mô tả: <?php echo $product["Description"]; ?>
                    </p>
                    <p>
                        <a href="./shopping_cart.php?id=<?php echo $product['ProductID']; ?>">
                            <button type="button" class="btn btn-danger">Mua hàng</button>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div style="padding-top: 10px;"></div>
        <h3 class="text-center">
            <div class="alert alert-danger">
               <span style="color: black;">Sản phẩm liên quan</span>
            </div>
        </h3>
        <div class="row">
            <?php foreach ($product_relate as $item) { ?>
                <div class="col-sm-4">
                    <a href="./productDetail.php?id=<?php echo $item['ProductID']; ?>">
                        <img src="<?php echo "../../public/imageProduct/" . $item['Picture'] ?>" class="img-reponsive" style="width: 100%" alt="Image">
                    </a>
                    <p class="text-danger">Tên sản phẩm: <?php echo $item['ProductName']; ?></p>
                    <p class="text-info">Giá: <?php echo $item['PriceProduct']; ?></p>
                    <p>
                        <button type="button" class="btn btn-primary" onclick="location.href='./shopping_cart.php?id=<?php echo $item['ProductID']; ?>'">Mua hàng</button>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include_once("../footer.php"); ?>