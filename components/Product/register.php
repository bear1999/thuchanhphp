<?php
require_once("../../Entities/User.class.php");
if (isset($_POST['btnSubmit'])) {
    $txtUser = $_POST['txtUser'];
    $txtEmail = $_POST['txtEmail'];
    $txtPass = $_POST['txtPass'];

    $newUser = new User($txtUser, $txtEmail, $txtPass);
    $result = $newUser->save();

    if (!$result)
        header("Location: register.php?fail");
    else header("Location: register.php?success");
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
        <title>Đăng ký</title>
    </head>
    <body>
        <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Đăng ký</h1>
            <?php 
                if(isset($_GET['fail'])) {
                    echo "<h3>Đăng ký thất bại</h3>";
                }
                else if(isset($_GET['success'])) {
                    echo "<h3>Đăng ký thành công</h3>";
                }
            ?>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form class="form-signin" method="POST" action="#">
                    <input type="text" class="form-control" placeholder="Username" name="txtUser" required autofocus>
                    <input type="email" class="form-control" placeholder="Email" name="txtEmail" required>
                    <input type="password" class="form-control" placeholder="Mật khẩu" name="txtPass" required>
                    <button class="btn btn-lg btn-primary btn-block" name="btnSubmit" type="submit">
                        Đăng ký</button>
                </form>
            </div>
            <a href="./login.php" class="text-center new-account">Đăng nhập </a>
        </div>
    </div>
</div>
    </body>
</html>




