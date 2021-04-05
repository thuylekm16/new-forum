<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(isset($_SESSION['user'])){
    header('location:index.php');
}
$errLogin = false;

if(isset($_POST['email'])){
    require_once('database/mysql.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND usertype ='1'";
    $connect = connect();
    $result = $connect->query($query);
    if($result->num_rows == 1){
        $_SESSION['user'] = $result->fetch_array();
        header('location:index.php');
    }else{
        $errLogin = true;
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diễn đàn</title>
    <link href="../template/css/global/style.css" rel="stylesheet" type="text/css">
    <link href="../template/css/global/header.css" rel="stylesheet" type="text/css">
    <link href="../template/css/global/footer.css" rel="stylesheet" type="text/css">
    <link href="../template/css/page/login.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <div class="container-header">
        <div class="title">
            <h2>Diễn đàn</h2>
        </div>
        <div class="user">
            <div class="user-login">
                <h2><a href="/login.php">Login</a></h2>
            </div>
            <div class="user-register">
                <h2><a href="register.php">Register</a></h2>
            </div>
        </div>
    </div>
</header>
<div class="body">
    <form action="" method="post">
        <div class="login-container">
            <div class="login-page">
                <h2>SIGN IN</h2>
                <div class="input">
                    <?php if($errLogin){
                        echo '<span style="color: red; display: block; ">Email or Password incorrect</span>';
                    } ?>
                    <div class="email">
                        <input type="name" name="email" placeholder="email">
                    </div>
                    <div class="password">
                        <input type="password" name="password" placeholder="password">
                    </div>
                </div>
                <div class="sign-in">
                    <button>Sign in</button>
                </div>
            </div>
        </div>
    </form>
</div>

<footer>
    <p>footer</p>
</footer>
</body>
</html>
