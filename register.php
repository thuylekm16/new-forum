<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$errorRePassword = false;
$errEmail = false;
$errRegister = false;
session_start();
if(isset($_SESSION['user'])){
    header('location:index.php');
}
if(isset($_POST['name'])){
    require_once('database/mysql.php');
    $fullname = $_POST['name'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re-password'];
    if($password == $re_password){
        $connect = connect();
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result = $connect->query($query);
        if($result->num_rows > 0 ){
            $errEmail = true;
        }else{
            $password = md5($password);
            $query = "INSERT INTO users (usertype,fullname, birthday, sex, email, password) VALUES ('1','$fullname','$birthday','$sex','$email','$password')";
            $result = $connect->query($query);
            if($result){
                header('location:login.php');
            }else{
                $errRegister = true;

            }
        }
    }else{
        $errorRePassword = true;
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
    <link href="../template/css/page/register.css" rel="stylesheet" type="text/css">
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
        <div class="register-container">
            <div class="register">
                <h2>REGISTER</h2>
                <?php if($errRegister)
                    echo '<span style="color: red; display: block;text-align: center">Register error</span>';
                ?>
                <div class="input">
                    <div class="name">
                        <input type="text" placeholder="name" name="name">
                    </div>
                    <div class="birthday">
                        <input type="text" placeholder="birthday" name="birthday">
                    </div>
                    <div class="sex">
                        <select name="sex">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    <div class="email">
                        <input type="email" placeholder="email" name="email">
                        <?php if($errEmail)
                            echo '<span style="color: red; display: block">Email already exist</span>'
                        ?>
                    </div>
                    <div class="password">
                        <input type="password" placeholder="password" name="password">
                    </div>
                    <div class="password">
                        <input type="password" placeholder="comfirm-password" name="re-password">
                        <?php if($errorRePassword)
                            echo '<span style="color: red; display: block">Confirm password incorrect</span>'
                        ?>
                    </div>
                </div>
                <div class="sign-in">
                    <button>Register</button>
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
