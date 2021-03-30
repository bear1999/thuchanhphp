<?php
    session_start();
    if(isset($_SESSION['login']) == false) {
        die("Please login");    
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
</body>
</html>