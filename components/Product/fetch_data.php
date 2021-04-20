<?php

include("./connect.php");

// if(isset($_POST["action"])) {
if(isset($_POST['cateid'])) {
    if($_POST['cateid'] == -1)
        $query = "SELECT * FROM product WHERE ProductID > -1";
    else $query = "SELECT * FROM product WHERE ProductID > -1 AND CateID = '".$_POST['cateid']."'";
}
else $query = "SELECT * FROM product WHERE ProductID > -1";
if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
    $query .= " AND PriceProduct BETWEEN '" . $_POST["minimum_price"] . "' AND '" . $_POST["maximum_price"] . "'";
}
if (isset($_POST["brand"])) {
    $brand_filter = implode("','", $_POST["brand"]);
    $query .= " AND productBrand IN ('" . $brand_filter . "')";
}
if (isset($_POST["ram"])) {
    $ram_filter = implode("','", $_POST["ram"]);
    $query .= " AND productRam IN ('" . $ram_filter . "')";
}
if (isset($_POST["storage"])) {
    $storage_filter = implode("','", $_POST["storage"]);
    $query .= " AND productStorage IN ('" . $storage_filter . "')";
}

$result = $conn->query($query);
// die($query);
$output = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= '
            <div class="col-sm-4 col-lg-3 col-md-3">
                <div style="border: 1px solid #ccc; border-radius: 5px; padding: 16px; margin-bottom: 16px; height: 450px;">
                    <img src="../../public/imageProduct/' . $row['Picture'] . '" alt="" class="img-reponsive" style="width: 100px; height: 100px;">
                    <p align="center">
                        <strong>
                            <a href="./productDetail.php?id='.$row['ProductID'].'">' . $row['ProductName'] . '</a>
                        </strong>
                    </p>
                    <h4 style="text-align: center;" class="text-danger">' . $row['PriceProduct'] . '</h4>
                    <p>Camera: ' . $row['productCamera'] . ' MP</br>
                        Brand: ' . $row['productBrand'] . '</br>
                        Ram: ' . $row['productRam'] . ' GB</br>
                        Storage: ' . $row['productStorage'] . ' GB</br>
                        Price: ' . $row['PriceProduct'] . '</br>
                    </p>
                </div>
            </div>
            ';
    }
} else {
    $output = '<h3>No data found</h3>';
}
echo $output;
// }
