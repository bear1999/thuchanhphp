<?php
require_once("../../Entities/Product.class.php");
require_once("../../Entities/Category.class.php");
require_once("./connect.php");
?>

<?php
include_once("../header.php");

$limit_default = 1;

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else $limit = 1;

if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
} else $current_page = 1;


if (!isset($_GET["cateid"])) {
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
                <a href="./listProduct.php?cateid=<?php echo $item['CateID']; ?>&page=1&limit=<?php echo $limit_default; ?>" style="text-decoration: none;">
                    <li class="list-group-item"><?php echo $item['CateName']; ?></li>
                </a>
            <?php } ?>
        </ul>
        <div class="list-group">
            <h3>Price</h3>
            <input type="input" class="form-control" id="hidden_minimum_price" value="1000" min="1000" /> </br>
            <input type="input" class="form-control" id="hidden_maximum_price" value="65000" max="65000" /> </br>
            <input class="form-control btn-success" value="Go" type="button">
            <!--<p id="price_show">1000 - 65000</p>-->
            <div id="price_range"></div>
        </div>
        <!--Brand-->
        <div class="list-group">
            <h3>Brand</h3>
            <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                <?php
                $query = "SELECT DISTINCT(productBrand) FROM product ORDER BY ProductID DESC";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="list-group-item checkbox">
                            <label>
                                <input type="checkbox" class="common_selector brand" value="<?php echo $row['productBrand']; ?>">
                                <?php echo $row['productBrand']; ?>
                            </label>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <!--Ram-->
        <div class="list-group">
            <h3>Ram</h3>
            <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                <?php
                $query = "SELECT DISTINCT(productRam) FROM product ORDER BY ProductID DESC";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="list-group-item checkbox">
                            <label>
                                <input type="checkbox" class="common_selector ram" value="<?php echo $row['productRam']; ?>">
                                <?php echo $row['productRam']; ?>
                            </label>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <!--Storage-->
        <div class="list-group">
            <h3>Storage</h3>
            <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                <?php
                $query = "SELECT DISTINCT(productStorage) FROM product ORDER BY ProductID DESC";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="list-group-item checkbox">
                            <label>
                                <input type="checkbox" class="common_selector storage" value="<?php echo $row['productStorage']; ?>">
                                <?php echo $row['productStorage']; ?>
                            </label>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div style="padding-top: 10px;"></div>
        <h3 class="text-center">
            <div class="alert alert-primary">
                <span style="color: black;">Sản phẩm cửa hàng</span>
            </div>
        </h3>
        <div class="row">
            <div class="filter_data row"></div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        filter_data();

        $('input').on('click', function() {
            filter_data();
        });

        function filter_data() {
            $('.filter_data').html('<div id="loading" style=""></div>');
            var action = 'fetch_data';
            var minimum_price = document.getElementById("hidden_minimum_price").value;
            var maximum_price = document.getElementById("hidden_maximum_price").value;
            console.log(minimum_price);
            var brand = get_filter('brand');
            var ram = get_filter('ram');
            var storage = get_filter('storage');
            $.ajax({
                url: "fetch_data.php",
                method: "POST",
                data: {
                    action: action,
                    minimum_price: minimum_price,
                    maximum_price: maximum_price,
                    brand: brand,
                    ram: ram,
                    storage: storage

                },
                success: function(data) {
                    $('.filter_data').html(data);
                }
            });
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function() {
            filter_data();
        })

        $('#price_ranger').slider({
            range: true,
            min: 1000,
            max: 65000,
            values: [1000, 65000],
            step: 500,
            stop: function(event, ui) {
                $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimun_price').val(ui.values[0]);
                $('#hidden_maximun_price').val(ui.values[1]);
                filter_data();
            }
        });
    });
</script>

<?php include_once("../footer.php"); ?>