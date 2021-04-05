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
    <title>Web bán hàng</title>
</head>
<body>
    <h4 style="padding-top: 10px; padding-left: 10px;">Xin chào, <?php echo $_SESSION['login']; ?> / <a href="/thuchanhphp/components/Product/logout.php">Thoát!</a></h4>
</body>
</html>