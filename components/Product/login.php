<?php
require_once("../../Entities/User.class.php");

if (isset($_POST['btnSubmit'])) {
    $txtUser = $_POST['txtUser'];
    $txtPass = $_POST['txtPass'];

    $result = User::checkLogin($txtUser, $txtPass);
    if ($result->num_rows > 0) {
        header("Location: ../../index.php");
        session_start();
        $_SESSION['login'] = $txtUser;
    }
    else header("Location: login.php?fail");
}
?>
<html>
    <head>
        <meta charset="utf8">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="../../public/assets/css/site.css" rel="stylesheet">
        <!--<link href="./public/assets/css/bootstrap.min.css" rel="stylesheet">
        <script src="./public/assets/js/bootstrap.min.js" rel="stylesheet"></script>-->
        <title>Đăng nhập</title>
    </head>
    <body>
        <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">ĐĂNG NHẬP</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form class="form-signin" action="#" method="POST">
                    <input type="text" class="form-control" placeholder="Username" name="txtUser" required autofocus>
                    <input type="password" class="form-control" placeholder="Mật khẩu" name="txtPass" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnSubmit">Đăng nhập</button>
                </form>
            </div>
            <a href="./register.php" class="text-center new-account">Tạo tài khoản </a>
        </div>
    </div>
</div>
    </body>
</html>




