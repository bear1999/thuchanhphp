<?php
require_once("../../Entities/Product.class.php");
require_once("../../Entities/Category.class.php");
?>

<?php
include_once("../header.php");

if(isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else $limit = 1;

if(isset($_GET['page'])) {
    $current_page = $_GET['page'];
} else $current_page = 1;

foreach(Product::totalRecords() as $item)
    $totalRecords = $item["Total"];

if(!isset($_GET["cateid"])) {
    $products = Product::listProduct($current_page, $limit);
} else {
    $cateid = $_GET["cateid"];
    $products = Product::list_product_by_cateid($cateid, $current_page, $limit);
}
$cates = Category::listCategory();
?>
<div class="row container">
    <div class="col-sm-3">
        <br>
        <ul class="list-group">
            <?php foreach ($cates as $item) { ?>
                <a href="./listProduct.php?cateid=<?php echo $item['CateID']; ?>&page=1&limit=1" style="text-decoration: none;">
                    <li class="list-group-item"><?php echo $item['CateName']; ?></li>
                </a>
            <?php } ?>
        </ul>
    </div>

    <div class="col-sm-9">
        <div style="padding-top: 10px;"></div>
        <h3 class="text-center">
            <div class="alert alert-primary">
               <span style="color: black;">Sản phẩm cửa hàng</span>
            </div>
        </h3>
        <div class="row">
            <?php foreach ($products as $item) { ?>
                <div class="col-sm-4">
                <?php if(!isset($_GET["cateid"])) { ?>
                    <a href="./productDetail.php?id=<?php echo $item['ProductID']; ?>">
                        <img src="<?php echo "../../public/imageProduct/" . $item['Picture'] ?>" class="img-reponsive" style="width: 100%" alt="Image">
                    </a>
                    <p class="text-danger">Tên sản phẩm: <?php echo $item['ProductName'] ?></p>
                    <p class="text-info">Giá: <?php echo $item['PriceProduct'] ?></p>
                    <p>
                        <button type="button" class="btn btn-primary" onclick="location.href='./shopping_cart.php?id=<?php echo $item['ProductID']; ?>'">Mua hàng</button>
                    </p>
                <?php }  else {?>
                    <a href="./productDetail.php?cateid=<?php echo $item['CateID'] ?>&id=<?php echo $item['ProductID']; ?>">
                        <img src="<?php echo "../../public/imageProduct/" . $item['Picture'] ?>" class="img-reponsive" style="width: 100%" alt="Image">
                    </a>
                    <p class="text-danger">Tên sản phẩm: <?php echo $item['ProductName'] ?></p>
                    <p class="text-info">Giá: <?php echo $item['PriceProduct'] ?></p>
                    <p>
                        <button type="button" class="btn btn-primary" onclick="location.href='./shopping_cart.php?id=<?php echo $item['ProductID']; ?>'">Mua hàng</button>
                    </p>
                <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="pagination">
            <?php
            if(!isset($_GET["cateid"])) {
                $total_page = Product::totalPage();
                if ($current_page > 1 && $total_page > 1)
                    echo '<a href="./listProduct.php?page='.($current_page-1).'&limit='.$limit.'" style="padding-right: 10px;">Prev</a>';
            } else {
                $current_cate = $_GET["cateid"];
                $total_page = Product::totalPageByCateID($current_cate);
                if ($current_page > 1 && $total_page > 1)
                    echo '<a href="./listProduct.php?cateid='.$current_cate.'&page='.($current_page-1).'&limit='.$limit.'" style="padding-right: 10px;">Prev</a> ';
            }
            
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span><div style="padding-left: 5px;"></div>';
                }
                else{
                    if(!isset($_GET["cateid"])) {
                        echo '<a href="./listProduct.php?page='.$i.'&limit='.$limit.'">'.$i.'</a> <div style="padding-left: 5px;"></div> ';
                    } 
                    else {
                        echo '<a href="./listProduct.php?cateid='.$current_cate.'&page='.$i.'&limit='.$limit.'">'.$i.'</a> <div style="padding-left: 5px;"></div> ';
                    }
                }
            }

            if(!isset($_GET["cateid"])) {
                 if ($current_page < $total_page && $total_page > 1)
                    echo '<a href="./listProduct.php?page='.($current_page+1).'&limit='.$limit.'">Next</a>';
            } else {
                if ($current_page < $total_page && $total_page > 1)
                    echo '<a href="./listProduct.php?cateid='.$current_cate.'&page='.($current_page+1).'&limit='.$limit.'">Next</a>';
            }

            ?>
        </div>
    </div>
</div>
<?php include_once("../footer.php"); ?>