<?php

$conn = new mysqli("localhost", "root", "", "ecommerce");

if($conn->connect_error) {
    die("Error DB");
}

?>