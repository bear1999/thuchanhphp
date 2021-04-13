<?php
    session_start();
    if(isset($_SESSION['login']) == false) {
        header("Location: /thuchanhphp/components/product/login.php");
        die();    
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf8">
    <link href="../../public/assets/css/site.css" rel="stylesheet">
    <link href="../../public/assets/css/bootstrap.min.css" rel="stylesheet">
    <!--<script scr="../../public/asset/jquery-3.6.0.min.js"></script>-->
    <script scr="../../public/assets/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script scr="../../public/assets/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="../../public/assets/jquery-ui-1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css">
    <title>Web bán hàng</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" style="padding-left: 5px;" href="../../index.php">Trang chủ</a>
    <h4 style="padding-top: 10px; padding-left: 10px; color: white;" class="navbar-brand">Xin chào, <?php echo $_SESSION['login']; ?> / <a href="/thuchanhphp/components/Product/logout.php">Thoát!</a></h4>
</nav>

    </body>
</html>