<?php
require_once("../../Entities/Product.class.php");
require_once("../../Entities/Category.class.php");

if (isset($_POST['btnSubmit'])) {
    $productName = $_POST['txtName'];
    $cateID = $_POST['txtCateID'];
    $Price = $_POST['txtPrice'];
    $Quantity = $_POST['txtQuantity'];
    $Description = $_POST['txtDescription'];
    $Picture = $_FILES['txtPicture'];

    $newProduct = new Product($productName, $cateID, $Price, $Quantity, $Description, $Picture);
    $result = $newProduct->save();

    if (!$result)
        header("Location: addProduct.php?failure");
    else header("Location: addProduct.php?inserted");
}
?>

<?php include_once("../../components/header.php"); ?>

<?php
if (isset($_GET['inserted'])) {
    echo "<h2 class='wrapper'>Thêm sản phẩm thành công</h2>";
}
?>
<div class="wrapper">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <h2>Thêm sản phẩm</h2>
        <!--Tên sp-->
        <div class="form-group row">
            <div class="col-sm-2 col-form-label">
                <label>Tên sản phẩm</label>
            </div>
            <div class="col-sm-10">
                <input type="text" name="txtName" value="<?php echo isset($_POST['txtName']) ? $_POST['txtName'] : "" ?>">
            </div>
        </div>
        <!--Mô tả sp-->
        <div class="form-group row"> <br>
            <div class="col-sm-2 col-form-label">
                <label>Mô tả sản phẩm</label>
            </div>
            <div class="col-sm-10">
                <textarea type="text" name="txtDescription" rows="5" cols="23" value="<?php echo isset($_POST['txtDescription']) ? $_POST['txtDescription'] : "" ?>"></textarea>
            </div>
        </div>
        <!--Số lượng-->
        <div class="form-group row"> <br>
            <div class="col-sm-2 col-form-label">
                <label>Số lượng sản phẩm</label>
            </div>
            <div class="col-sm-10">
                <input type="number" name="txtQuantity" value="<?php echo isset($_POST['txtQuantity']) ? $_POST['txtQuantity'] : "" ?>">
            </div>
        </div>
        <!--Giá-->
        <div class="form-group row"> <br>
            <div class="col-sm-2 col-form-label">
                <label>Giá sản phẩm</label>
            </div>
            <div class="col-sm-10">
                <input type="number" name="txtPrice" value="<?php echo isset($_POST['txtPrice']) ? $_POST['txtPrice'] : "" ?>">
            </div>
        </div>
        <!--Loại sp-->
        <div class="form-group row"> <br>
            <div class="col-sm-2 col-form-label">
                <label>Loại sản phẩm</label>
            </div>
            <div class="col-sm-10">
                <select name="txtCateID">
                    <option value="" selected>---Chọn loại---</option>
                    <?php
                    $cates = Category::listCategory();
                    foreach ($cates as $item) {
                        echo "<option value=" . $item['CateID'] . ">" . $item['CateName'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <!--hình ảnh-->
        <div class="form-group row"> <br>
            <div class="col-sm-2 col-form-label">
                <label>Đường dẫn hình ảnh sản phẩm</label>
            </div>
            <div class="col-sm-10">
                <input type="file" id="txtPicture" name="txtPicture" accept=".PNG,.GIF,.JPG">
            </div>
        </div>
        <!--btnSubmit-->
        <div class="form-group row"> <br>
            <div class="submit">
                <input type="submit" name="btnSubmit" value="Thêm sản phẩm">
            </div>
        </div>
    </form>
</div>

<?php include_once("../../components/footer.php") ?>