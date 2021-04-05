<?php
session_start();
unset($_SESSION["cart_items"]);
header("Location: ./listProduct.php");
?>